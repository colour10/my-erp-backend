<?php

namespace Multiple\Home\Controllers;

use Phalcon\Mvc\Controller;
use Phalcon\Mvc\View;
use Asa\Erp\TbSales;
use Asa\Erp\TbCompany;
use Asa\Erp\Util;
use Asa\Erp\TbSalesdetails;

/**
 * 销售单主表
 */
class SalesController extends CadminController
{
    // 销售单参数
    protected $saleParams;
    // 销售单id
    protected $salesid;
    // 销售单号
    protected $saleno;
    // 当前用户
    protected $userid;

    public function initialize()
    {
        parent::initialize();

        $this->setModelName('Asa\\Erp\\TbSales');

        // 当前用户
        $this->userid = $this->auth['id'];
    }

    /**
     * 销售单保存
     */
    public function savesaleAction()
    {
        // 判断是否有params参数提交过来
        $params = $this->request->get('params');
        if (!$params) {
            $msg = $this->getValidateMessage('sales-params', 'template', 'required');
            return $this->error([$msg]);
        }
        // 转换成数组
        $submitData = json_decode($params, true);

        // // 判断销售单是否有数据
        // // 销售单数据可以为空，暂时注释
        // if (count($this->saleParams['list']) == '0') {
        //     return $this->error(['sale list is empty']);
        // }
        // 
        
        // 采用事务处理
        $this->db->begin();

        // 判断是否有销售单号，分别进行
        $salesid = (int)$submitData['form']['id'];
        // 判断逻辑
        if ($salesid>0) {
            // 有销售单号就修改
            // 查找销售单号是否存在
            $sale = TbSales::findFirstById($salesid);
            if (!$sale) {
                $msg = $this->getValidateMessage('sale', 'template', 'notexist');
                return $this->error([$msg]);
            }

            // 开始更新
            foreach ($submitData['form'] as $k => $item) {
                // 把里面的参数转成post参数传递过去
                $sale->$k = $item;
            }

            if($sale->update()==false) {
                $this->db->rollback();
                return $this->error(['updage-fail']);
            }
        } else {
            $sale = new TbSales();

            // 开始更新
            foreach ($submitData['form'] as $k => $item) {
                // 把里面的参数转成post参数传递过去
                $sale->$k = $item;
            }

            if($sale->create()==false) {
                $this->db->rollback();
                return $this->error(['create-fail']);
            }
        }

        $detail_id_array = [];
        foreach ($submitData['list'] as $k => $item) {
            // 使用模型更新
            
            $data = [
                'productstockid' => $item['productstockid'],
                'dealprice' => $item['dealprice'],
                'number' => $item['number'],
                'price' => $item['price'],
                'discount' => $item['discount'],
                'companyid' => $this->companyid,
                'salesid' => $sale->id
            ];
            if(isset($item['id']) && $item['id']!='') {
                $data['id'] = $item['id'];
                $detailRet = $sale->updateDetail($data);
            }
            else {
                $detailRet = $sale->addDetail($data);
            }
            if ($detailRet===false) {
                $this->db->rollback();
                $msg = $this->getValidateMessage('orderdetail', 'db', 'add-failed');
                return $this->error([$msg]);
            }
            $detail_id_array[] = $detailRet->id;
        }

        //清除不存在的详情id
        if(count($detail_id_array)>0) {
            $details = TbSalesdetails::find(
                sprintf("salesid=%d and id not in(%s)", $sale->id, implode(",", $detail_id_array))
            );
            foreach($details as $detail) {
                $detail->delete();
            }
        }

        // 提交事务
        $this->db->commit();

        // 取出单个模型及下级销售单详情逻辑
        echo $this->success($sale->getOrderDetail());
    }


    /**
     * 读取销售单信息，必须传一个id参数，代表销售单编号
     * @return false|string
     */
    public function loadsaleAction()
    {
        $order = TbSales::findFirst(
            sprintf("id=%d and companyid=%d", $_REQUEST["id"], $this->companyid)
        );
        // 判断订单是否存在
        if ($order!=false) {
            echo $this->success($order->getOrderDetail());
        }
    }

    /**
     * 销售单删除
     * 貌似不能删除，只能作废，但是在后台要求能看到状态
     * 初步想法是，该怎么删还是怎么删，但是查询的时候，把这条软删除（作废）的记录也给显示出来
     * @return false|string
     */
    public function deleteAction()
    {
        // 必须传递一个销售单id
        if (!$this->request->get('id')) {
            $msg = $this->getValidateMessage('sale', 'template', 'required');
            return $this->error([$msg]);
        }
        $this->salesid = $this->request->get('id');
        // 根据salesid查询出当前销售单以及销售单详情的所有信息
        $sale = TbSales::findFirstById($this->salesid);
        // 判断销售单是否存在
        if (!$sale) {
            $msg = $this->getValidateMessage('sale', 'template', 'notexist');
            return $this->error([$msg]);
        }
        // 继续执行其他方法
        parent::deleteAction();
    }
}
