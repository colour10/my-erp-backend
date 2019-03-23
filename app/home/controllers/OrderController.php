<?php

namespace Multiple\Home\Controllers;

use Asa\Erp\DdOrderdetails;
use Asa\Erp\TbCompany;
use Asa\Erp\Util;
use Asa\Erp\ZlSizecontent;
use Phalcon\Mvc\Controller;
use Phalcon\Mvc\View;
use Asa\Erp\DdOrder;

/**
 * 订单主表
 */
class OrderController extends CadminController
{
    // 订单参数
    protected $orderParams;
    // 订单id
    protected $orderid;
    // // 字段名称，sizecontent已不再需要，注释掉
    // protected $zlcontent_field_name;
    // 当前用户
    protected $userid;
    // 权限提示msg
    protected $permission_msg;

    public function initialize()
    {
        parent::initialize();

        $this->setModelName('Asa\\Erp\\DdOrder');

        // // 确定字段名称，sizecontent已不再需要，注释掉
        // // 拿到当前尺码字段名称
        // $zlcontent = new ZlSizecontent();
        // $this->zlcontent_field_name = $zlcontent->getColumnName('content');

        // 当前用户
        $this->userid = $this->auth['id'];

        // 权限提示
        $this->permission_msg = $this->getValidateMessage('order-gurd-alert-message');
    }

    /**
     * 订单保存
     */
    public function saveorderAction()
    {
        // 判断是否有params参数提交过来
        $params = $this->request->get('params');
        if (!$params) {
            $msg = $this->getValidateMessage('order-params', 'template', 'required');
            return $this->error([$msg]);
        }
        // 转换成数组
        $submitData = json_decode($params, true);

        // 订单主表中，开始验证必填字段
        // 年代id、供货商id为必填项

        // // 判断订单是否有数据
        // // 订单数据可以为空，暂时注释
        // if (count($submitData['list']) == '0') {
        //     return $this->error(['order list is empty']);
        // }

        // 判断是否有订单号，分别进行
        $orderid = $submitData['form']['id'];

        // 采用事务处理
        $this->db->begin();

        // 判断逻辑
        if ($orderid) {
            // 有订单号就修改
            // 查找订单号是否存在
            $order = DdOrder::findFirstById($orderid);
            if (!$order) {
                $msg = $this->getValidateMessage('order', 'template', 'notexist');
                return $this->error([$msg]);
            }

            // 判断当前订单是否属于当前用户所在公司
            if (!$this->check_if_self_company_order($order->companyid)) {
                return $this->error([$this->permission_msg]);
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
                $messages = $order->getMessages();
                foreach ($messages as $message) {
                    $result[] = $message->getMessage();
                }
                return $this->error($result);
            }
        }
        else {
            // 没有订单号就新增
            $order = new DdOrder();
            foreach ($submitData['form'] as $k => $item) {
                $order->$k = $item;
            }

            // 添加制单人及制单日期
            $order->makestaff = $this->userid;
            $order->makedate = date('Y-m-d H:i:s');
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
            }
        }
          

        // 开始写入订单详情表
        // 需要引入订单详情表模型
        // $this->addOrderDetail();
        // 然后新增订单详情
        // 封装的过程中如果操作失败会回滚，所以放弃了封装，直接放在这里显示
        foreach ($submitData['list'] as $k => $item) {
            // 使用模型更新
            $data = [
                'productid' => $item['productid'],
                'sizecontentid' => $item['sizecontentid'],
                'number' => $item['number'],
                'companyid' => $this->companyid,
                'orderid' => $order->id
            ];
            if(isset($item['id']) && $item['id']!='') {
                $data['id'] = $item['id'];
                $detailRet = $order->updateDetail($data);
            }
            else {
                $detailRet = $order->addDetail($data);
            }

            if (!$detailRet) {
                $this->db->rollback();
                $msg = $this->getValidateMessage('orderdetail', 'db', 'add-failed');
                return $this->error([$msg]);
            }
        }

        // 提交事务
        $this->db->commit();

        // 取出单个模型及下级订单详情逻辑
        $this->getOrder($order->id);
    }


    /**
     * 读取订单信息，必须传一个id参数，代表订单编号
     * @return false|string
     */
    public function loadorderAction()
    {
        // 必须传递一个订单id
        if (!$this->request->get('id')) {
            $msg = $this->getValidateMessage('order', 'template', 'required');
            return $this->error([$msg]);
        }
        $this->orderid = $this->request->get('id');
        // 取出单个模型及下级订单详情逻辑
        $this->getOrder($this->orderid);
    }

    // /**
    //  * 订单详情表分功能，内嵌共通，因为涉及到事务回滚，如果操作失败就报错，所以此封装作废
    //  */
    // private function addOrderDetail()
    // {
    //     foreach ($this->orderParams['list'] as $k => $item) {
    //         if (isset($item)) {
    //             $_POST = $item;
    //             // 加入订单
    //             $_POST['orderid'] = $this->orderid;
    //         }
    //
    //         // 判断接收的参数是否正常
    //         if (
    //             array_key_exists('productid', $_POST) ||
    //             array_key_exists('sizecontentid', $_POST) ||
    //             array_key_exists('number', $_POST) ||
    //             array_key_exists('orderid', $_POST)
    //         ) {
    //             $this->db->rollback();
    //             $msg = $this->getValidateMessage('orderdetail', 'db', 'add-failed');
    //             return $this->error([$msg]);
    //         }
    //         if (
    //             !$_POST['productid'] ||
    //             !$_POST['sizecontentid'] ||
    //             !$_POST['number'] ||
    //             !$_POST['orderid']
    //         ) {
    //             $this->db->rollback();
    //             $msg = $this->getValidateMessage('orderdetail', 'db', 'add-failed');
    //             return $this->error([$msg]);
    //         }
    //
    //         // 使用模型更新
    //         $orderDetail = new DdOrderdetails();
    //         $data = [
    //             'productid' => $_POST['productid'],
    //             'sizecontentid' => $_POST['sizecontentid'],
    //             'number' => $_POST['number'],
    //             'companyid' => $this->companyid,
    //             'orderid' => $_POST['orderid'],
    //         ];
    //         if (!$orderDetail->save($data)) {
    //             $this->db->rollback();
    //             $msg = $this->getValidateMessage('orderdetail', 'db', 'add-failed');
    //             return $this->error([$msg]);
    //         }
    //     }
    // }


    /**
     * 根据订单id查询出每个订单下面的模型和具体订单详情
     * @param $orderid
     * @return false|string
     */
    public function getOrder($orderid)
    {
        // 根据orderid查询出当前订单以及订单详情的所有信息
        $order = DdOrder::findFirstById($orderid);
        // 判断订单是否存在
        if (!$order) {
            $msg = $this->getValidateMessage('orderdetail', 'template', 'notexist');
            echo $this->error([$msg]);
            exit;
        }
        
        $data = [
            'form' => $order->toArray(),
            'list'=>[]
        ];

        // 循环添加数据
        foreach ($order->orderdetails as $k => $orderdetail) {
            $orderdetail_array = $orderdetail->toArray();
            $orderdetail_array['product'] = $orderdetail->product->toArray();
            $data['list'][] = $orderdetail_array;
        }
        // 最终成功返回，原来的数据还要保留，再加上订单详情之中每个商品的名称也要放进去
        echo $this->success($data);
        $this->view->disable();
    }

    /**
     * 订单删除
     * @return false|string
     */
    public function deleteAction()
    {
        // 必须传递一个订单id
        if (!$this->request->get('id')) {
            $msg = $this->getValidateMessage('order', 'template', 'required');
            return $this->error([$msg]);
        }
        $this->orderid = $this->request->get('id');

        // 根据orderid查询出当前订单以及订单详情的所有信息
        $order = DdOrder::findFirstById($this->orderid);
        // 判断订单是否存在
        if (!$order) {
            $msg = $this->getValidateMessage('order', 'template', 'notexist');
            return $this->error([$msg]);
        }

        // 判断当前订单是否属于当前用户所在公司
        if (!$this->check_if_self_company_order($order->companyid)) {
            return $this->error([$this->permission_msg]);
        }

        // 继续执行其他方法
        parent::deleteAction();
    }

    /**
     * 判断当前订单是否属于当前用户所在公司
     * @param $companyid
     * @return bool
     */
    public function check_if_self_company_order($companyid)
    {
        // 逻辑
        if ($this->companyid != $companyid) {
            return false;
        }
        // 否则返回真
        return true;
    }

    /**
     * 订单审核
     * @return [type] [description]
     */
    public function confirmAction() {
        $orderid = (int)$_POST['id'];

        // 根据orderid查询出当前订单以及订单详情的所有信息
        $order = DdOrder::findFirstById($orderid);
        if($order!=false && $order->companyid==$this->companyid) {
            $order->status = $_POST['status']=="3" ? 3: 1;

            $this->doTableSave($order);
        }

        $this->view->disable();
    }

    /**
     * 订单取消审核，如果订单上的明细已经生成入库单，则不能取消审核
     * @return [type] [description]
     */
    public function cancelAction() {
        $orderid = (int)$_POST['id'];

        // 根据orderid查询出当前订单以及订单详情的所有信息
        $order = DdOrder::findFirstById($orderid);
        if($order!=false && $order->companyid==$this->companyid) {
            $order->status = 2;

            $this->doTableSave($order);             
        }

        $this->view->disable();
    }

    /**
     * 订单完结
     * @return [type] [description]
     */
    public function finishAction() {
        $orderid = (int)$_POST['id'];

        // 根据orderid查询出当前订单以及订单详情的所有信息
        $order = DdOrder::findFirstById($orderid);
        if($order!=false && $order->companyid==$this->companyid) {
            $order->isstatus = 1;

            $this->doTableSave($order);            
        }

        $this->view->disable();
    }

    private function doTableSave($model) {
        if ($order->save() === false) {
            $messages = $order->getMessages();
            $array = [];
            foreach ($messages as $message) {
                $array[] = $message->getMessage();
            }
            echo $this->error($array);
        }
        else {
            echo $this->success();
        }
        $this->view->disable();
    }
}
