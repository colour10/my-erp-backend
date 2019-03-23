<?php

namespace Multiple\Home\Controllers;

use Asa\Erp\DdConfirmorderdetails;
use Asa\Erp\TbProduct;
use Phalcon\Mvc\Controller;
use Phalcon\Mvc\View;
use Asa\Erp\DdConfirmorder;
use Asa\Erp\DdOrder;
use Asa\Erp\DdOrderdetails;
use Phalcon\Filter;
use Asa\Erp\TbCompany;
use Asa\Erp\Util;

/**
 * 发货单主表
 */
class ConfirmorderController extends BaseController {
    // 权限提示msg
    protected $permission_msg;

    /**
     * 初始化
     */
    public function initialize() {
        parent::initialize();

        // 权限提示
        $this->permission_msg = $this->getValidateMessage('confirmorder-gurd-alert-message');
    }

    public function pageAction() {
        $result = DdConfirmorder::find(
            sprintf("companyid=%d", $this->companyid)
        );

        echo $this->success($result->toArray());
    }


    /**
     * 首先选择供货商和年代（也可以不选），然后把结果显示出来
     * @return false|string
     */
    public function searchAction()
    {
        // // 判断是否有params参数提交过来
        // $params = $this->request->get('params');
        // // 如果参数不为空，那么就开始解析
        // if (!$params) {
        //     $msg = $this->getValidateMessage('confirmorder-params', 'template', 'required');
        //     return $this->error([$msg]);
        // }
        // // 转换成数组
        // $arr = json_decode($params, true);
        // $this->confirmorderParams = $arr;
        // $formdata = $this->confirmorderParams['form'];

        $wherelist = [sprintf("companyid=%d and status=3", $this->companyid)];
        if(isset($_POST['supplierid']) && $_POST['supplierid']!="") {
            $wherelist[] = sprintf('supplierid = %d', $_POST['supplierid']);
        }

        if(isset($_POST['ageseason']) && $_POST['ageseason']!="") {
            $wherelist[] = sprintf('ageseason = %d', $_POST['ageseason']);
        }

        // 开始查询，可能会查询到多条发货单，再根据每条发货单去查询当前记录的详情列表
        $orders = DdOrder::find(implode(' and ', $wherelist));

        if(count($orders)>0) {
            $order_id_array = [];
            foreach($orders as $order) {
                $order_id_array[] = $order->id;
            }

            $result = DdOrderdetails::find(
                //暂时先不限定status=3
                //sprintf("orderid in(%s) and status=3 and actualnumber<number", implode(",", $order_id_array))
                sprintf("orderid in(%s) and actualnumber<number", implode(",", $order_id_array))
            );

            $productlist = [];
            $hashmap = [];
            foreach($result as $row) {
                if(!in_array($row->productid, $hashmap)) {
                    $productlist[] = $row->product->toArray();
                    $hashmap[] = $row->productid;
                }
            }

            $result = [
                'list' => $result->toArray(),
                'productlist' => $productlist
            ];

            echo $this->success($result);
        }
    }

    /**
     * 确认发货单
     */
    public function saveorderAction()
    {
        // 判断是否有params参数提交过来
        $params = $this->request->get('params');
        // 如果参数不为空，那么就开始解析
        if (!$params) {
            $msg = $this->getValidateMessage('confirmorder-params', 'template', 'required');
            return $this->error([$msg]);
        }
        // 转换成数组
        $submitData = json_decode($params, true);

        // 判断是否有发货单号，分别进行
        $orderid = $submitData['form']['id'];

        // 采用事务处理
        $this->db->begin();

        // 判断逻辑
        if ($orderid) {
            // 有发货单号就修改
            // 查找发货单号是否存在
            $order = DdConfirmorder::findFirst(
                sprintf("id=%d and companyid=%d", $orderid, $this->companyid)
            );
            if(!$order || $order->status!=1) {
                exit;
            }

            // 开始更新
            foreach ($submitData['form'] as $k => $item) {
                // 把里面的参数转成post参数传递过去
                $order->$k = $item;
            }

            // 判断是否成功
            if (!$order->save()) {
                $this->db->rollback();
                // 验证类错误给出提示
                return $this->error($order);
            }

        } else {
            // 没有发货单号就新增
            // 采用事务处理

            // 没有订单号就新增
            $order = new DdConfirmorder();
            foreach ($submitData['form'] as $k => $item) {
                $order->$k = $item;
            }

            // 添加制单人及制单日期
            $order->makestaff = $this->currentUser;
            $order->makedate = date('Y-m-d H:i:s');
            $order->companyid = $this->companyid;

            // 生成主单号
            $order->orderno = sprintf(
                "C%s%s%s", 
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

        $detail_id_array = [];
        foreach ($submitData['list'] as $k => $item) {
            // 使用模型更新
            $data = [
                'productid' => $item['productid'],
                'sizecontentid' => $item['sizecontentid'],
                'number' => $item['number'],
                'orderdetailsid' => $item['orderdetailsid'],
                'companyid' => $this->companyid,
                'confirmorderid' => $order->id
            ];
            if(isset($item['id']) && $item['id']!='') {
                $data['id'] = $item['id'];
                $detailRet = $order->updateDetail($data);
            }
            else {
                $detailRet = $order->addDetail($data);
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
            $details = DdConfirmorderdetails::find(
                sprintf("confirmorderid=%d and id not in(%s)", $order->id, implode(",", $detail_id_array))
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
     * 读取发货单信息，必须传一个id参数，代表发货单编号
     * @return false|string
     */
    public function loadorderAction()
    {
        // 根据orderid查询出当前订单以及订单详情的所有信息
        $order = DdConfirmorder::findFirst(
            sprintf("id=%d and companyid=%d", $_REQUEST["id"], $this->companyid)
        );

        // 判断订单是否存在
        if ($order!=false) {
            echo $this->success($order->getOrderDetail());
        }
    }
}
