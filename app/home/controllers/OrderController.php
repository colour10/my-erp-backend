<?php
namespace Multiple\Home\Controllers;
use Asa\Erp\TbOrderdetails;
use Asa\Erp\TbCompany;
use Asa\Erp\Util;
use Phalcon\Mvc\Controller;
use Asa\Erp\TbOrder;
use Asa\Erp\TbProduct;
/**
 * 订单主表
 */
class OrderController extends BaseController
{
    public function initialize()
    {
        parent::initialize();
    }
    
    public function pageAction() {
        $result = TbOrder::find(
            sprintf("companyid=%d", $this->companyid)
        );
        echo $this->success($result->toArray());
    }

    /**
     * 订单保存
     */
    public function saveorderAction()
    {
        // 判断是否有params参数提交过来
        $params = $this->request->get('params');
        if (!$params) {
            throw new \Exception("/1001/参数错误/");
        }

        // 转换成数组
        $submitData = json_decode($params, true);

        // 判断是否有订单号，分别进行
        $orderid = $submitData['form']['id'];
        // 采用事务处理
        $this->db->begin();
        $form = $submitData['form'];

        // 判断逻辑
        if ($orderid) {
            // 有订单号就修改
            // 查找订单号是否存在或者非法
            // 只有status=1的订单才可以修改
            $order = TbOrder::findFirst(
                sprintf("id=%d and companyid=%d", $orderid, $this->companyid)
            );
            if(!$order || $order->status!=1) {
                throw new \Exception("/1001/订单不存在/");
            }

            $order->bookingid = $form['bookingid'];
            $order->linkmanid = $form['linkmanid'];
            $order->bussinesstype = $form['bussinesstype'];
            $order->supplierid = $form['supplierid'];
            $order->finalsupplierid = $form['finalsupplierid'];
            $order->ageseason = $form['ageseason'];
            $order->seasontype = $form['seasontype'];
            $order->bookingorderno = $form['bookingorderno'];
            $order->makedate = $form['makedate'];
            $order->currency = $form['currency'];
            $order->discount = $form['discount'];
            $order->taxrebate = $form['taxrebate'];
            $order->property = $form['property'];
            $order->memo = $form['memo'];
            $order->orderdate = $form['orderdate'];
            $order->status = $form['status'];

            // 判断是否成功
            if (!$order->save()) {
                $this->db->rollback();
                // 验证类错误给出提示
                return $this->error($order);
            }
        }
        else {
            // 没有订单号就新增
            $order = new TbOrder();            
            $order->bookingid = $form['bookingid'];
            $order->linkmanid = $form['linkmanid'];
            $order->bussinesstype = $form['bussinesstype'];
            $order->supplierid = $form['supplierid'];
            $order->finalsupplierid = $form['finalsupplierid'];
            $order->ageseason = $form['ageseason'];
            $order->seasontype = $form['seasontype'];
            $order->bookingorderno = $form['bookingorderno'];
            $order->makedate = $form['makedate'];
            $order->currency = $form['currency'];
            $order->discount = $form['discount'];
            $order->taxrebate = $form['taxrebate'];
            $order->property = $form['property'];
            $order->memo = $form['memo'];
            $order->orderdate = $form['orderdate'];
            $order->status = $form['status'];
            // 添加制单人及制单日期
            $order->makestaff = $this->currentUser;
            $order->maketime = date('Y-m-d H:i:s');
            $order->companyid = $this->companyid;
            // 生成订单号
            $order->orderno = sprintf(
                "D%s%s%s",
                substr("000000".$this->companyid, -6),
                date('YmdHis'),
                mt_rand(1000, 9999)
            );
            if($order->create() === false) {
                //返回失败信息
                $this->db->rollback();
                return $this->error($order);
            }
        }

        // 开始写入订单详情表
        // 需要引入订单详情表模型
        // $this->addOrderDetail();
        // 然后新增订单详情
        // 封装的过程中如果操作失败会回滚，所以放弃了封装，直接放在这里显示
        $detail_id_array = [];
        foreach ($submitData['list'] as $k => $item) {
            // 使用模型更新
            $detail = TbOrderdetails::findFirst(
                sprintf("companyid=%d and orderid=%d and productid=%d and sizecontentid=%d", $this->companyid, $order->id, $item['productid'], $item['sizecontentid'])
            );
            if($detail!=false) {
                $detail->number = $item['number'];
                $detail->discount = $item['discount'];
                $detail->price = TbProduct::getInstance($item['productid'])->factoryprice;
                $detail->currencyid = TbProduct::getInstance($item['productid'])->factorypricecurrency;
                if($detail->update()==false) {
                    $this->db->rollback();
                    throw new \Exception("/1002/更新订单明细失败/");                    
                }
            }
            else {
                $detail = new TbOrderdetails();
                $detail->productid = $item['productid'];
                $detail->sizecontentid = $item['sizecontentid'];
                $detail->number = $item['number'];
                $detail->discount = $item['discount'];
                $detail->companyid = $this->companyid;
                $detail->price = TbProduct::getInstance($item['productid'])->factoryprice;
                $detail->currencyid = TbProduct::getInstance($item['productid'])->factorypricecurrency;
                $detail->createdate = date("Y-m-d H:i:s");
                $detail->orderid = $order->id;
                $detail->orderbrandid= 0;
                if($detail->create()==false) {
                    $this->db->rollback();
                    throw new \Exception("/1002/添加订单明细失败/");                    
                }
            }

            $detail_id_array[] = $detail->id;
        }
        //清除不存在的详情id
        if(count($detail_id_array)>0) {
            $details = TbOrderdetails::find(
                sprintf("orderid=%d and id not in(%s)", $order->id, implode(",", $detail_id_array))
            );
            foreach($details as $detail) {
                $detail->delete();
            }
        }

        // 提交事务
        $this->db->commit();
        // 最终成功返回，原来的数据还要保留，再加上订单详情之中每个商品的名称也要放进去
        echo $this->success($order->getOrderDetail());
    }

    /**
     * 读取订单信息，必须传一个id参数，代表订单编号
     * @return false|string
     */
    public function loadorderAction()
    {
        // 根据orderid查询出当前订单以及订单详情的所有信息
        $order = TbOrder::findFirst(
            sprintf("id=%d and companyid=%d", $_REQUEST["id"], $this->companyid)
        );

        // 判断订单是否存在
        if ($order!=false) {
            echo $this->success($order->getOrderDetail());
        }
    }

    /**
     * 订单删除
     * @return false|string
     */
    public function deleteAction()
    {
        // 根据orderid查询出当前订单以及订单详情的所有信息
        $order = TbOrder::findFirst(
            sprintf("id=%d and companyid=%d", $_GET["id"], $this->companyid)
        );
        // 判断订单是否存在
        if ($order!=false && (int)$order->status==1) {
            $this->doTableAction($order,"delete");
        }
        else {
        }
    }

    /**
     * 订单完结
     * @return [type] [description]
     */
    public function finishAction() {
        $orderid = (int)$_POST['id'];
        // 根据orderid查询出当前订单以及订单详情的所有信息
        $order = TbOrder::findFirstById($orderid);
        if($order!=false && $order->companyid==$this->companyid) {
            $order->isstatus = 1;
            $this->doTableAction($order,"update");
        }
    }

    /**
     * 
     */
    function searchdetailAction() {
        $details = TbOrderdetails::find(
            sprintf("companyid=%d and orderbrandid=0", $this->companyid)
        );

        return $this->success($details->toArray());
    }
}