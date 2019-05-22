<?php
namespace Multiple\Home\Controllers;

use Phalcon\Mvc\Controller;
use Phalcon\Mvc\View;
use Asa\Erp\TbShipping;
use Asa\Erp\TbShippingDetail;
use Asa\Erp\TbOrderdetails;
use Asa\Erp\Util;

/**
 * 发货单主表
 */
class ShippingController extends AdminController {
    public function initialize() {
	    parent::initialize();

	    $this->setModelName('Asa\\Erp\\TbShipping');
    }

    function addAction() {
        // 判断是否有params参数提交过来
        $params = $this->request->get('params');
        if (!$params) {
            throw new \Exception("/1001/参数错误/");
        }

        // 转换成数组
        $submitData = json_decode($params, true);

        // 采用事务处理
        $this->db->begin();
        $form = $submitData['form'];

        $shipping = new TbShipping();            
        $shipping->supplierid = $form["supplierid"];
        $shipping->finalsupplierid = $form["finalsupplierid"];
        $shipping->ageseason = $form["ageseason"];
        $shipping->seasontype = $form["seasontype"];
        $shipping->property = $form["property"];
        $shipping->currency = $form["currency"];
        $shipping->bussinesstype = $form["bussinesstype"];
        $shipping->warehouseid = $form["warehouseid"];
        $shipping->total = $form["total"];
        $shipping->exchangerate = $form["exchangerate"];
        $shipping->paydate = $form["paydate"];
        $shipping->dd_company = $form["dd_company"];
        $shipping->apickingdate = $form["apickingdate"];
        $shipping->flightno = $form["flightno"];
        $shipping->flightdate = $form["flightdate"];
        $shipping->mblno = $form["mblno"];
        $shipping->hblno = $form["hblno"];
        $shipping->dispatchport = $form["dispatchport"];
        $shipping->deliveryport = $form["deliveryport"];
        $shipping->box_number = $form["box_number"];
        $shipping->weight = $form["weight"];
        $shipping->volume = $form["volume"];
        $shipping->chargedweight = $form["chargedweight"];
        $shipping->transcompany = $form["transcompany"];
        $shipping->invoiceno = $form["invoiceno"];
        $shipping->aarrivaldate = $form["aarrivaldate"];
        $shipping->buyerid = $form["buyerid"];
        $shipping->sellerid = $form["sellerid"];
        $shipping->transporttype = $form["transporttype"];
        $shipping->paytype = $form["paytype"];
        $shipping->estimatedate = $form["estimatedate"];

        // 添加制单人及制单日期
        $shipping->makestaff = $this->currentUser;
        $shipping->maketime = date('Y-m-d H:i:s');
        $shipping->companyid = $this->companyid;
        // 生成订单号
        $shipping->orderno = sprintf(
            "S%s%s%s",
            substr("000000".$this->companyid, -6),
            date('YmdHis'),
            mt_rand(1000, 9999)
        );
        if($shipping->create() === false) {
            //返回失败信息
            $this->db->rollback();
            return $this->error($shipping);
        }

        // 开始写入订单详情表
        foreach ($submitData['list'] as $k => $item) {
            $detail = new TbShippingDetail();
            $detail->productid = $item['productid'];
            $detail->sizecontentid = $item['sizecontentid'];
            $detail->number = $item['number'];
            $detail->discount = $item['discount'];
            $detail->price = $item['price'];
            $detail->createdate = date("Y-m-d H:i:s");
            $detail->orderdetailsid = $item['orderdetailsid'];
            $detail->orderid = $item['orderid'];
            $detail->shippingid= $shipping->id;
            if($detail->create()==false) {
                $this->db->rollback();
                throw new \Exception("/1002/添加订单明细失败/");                    
            }
        }

        // 提交事务
        $this->db->commit();
        return $this->success($shipping->toArray());
    }

    function loadAction() {
        $shipping = TbShipping::findFirst(
            sprintf("id=%d and companyid=%d", $_REQUEST["id"], $this->companyid)
        );

        // 判断订单是否存在
        if ($shipping!=false) {

            $details = $shipping->shippingDetail;

            $array = [];
            $hash = [];
            foreach($details as $row) {   
                $key = sprintf("%s-%s", $row->productid, $row->orderid);
                $hash[$key] = 1; 
            }

            foreach($hash as $key=>$value) {
                $temp = explode('-', $key);
                $array[] = sprintf("(orderid=%d and productid=%d)", $temp[1], $temp[0]);
            }

            if(count($array)>0) {
                $orderdetails_list = TbOrderdetails::find(
                    implode(" or ", $array)
                )->toArray();
            }
            else {
                $orderdetails_list = [];
            }

            $result = [
                "form" => $shipping->toArray(),
                "list" => $details->toArray(),
                "orderdetails_list" => $orderdetails_list
            ];
            echo $this->success($result);
        }
    }
}
