<?php
namespace Multiple\Home\Controllers;
use Asa\Erp\DdOrderdetails;
use Asa\Erp\TbCompany;
use Asa\Erp\Util;
use Asa\Erp\ZlSizecontent;
use Phalcon\Mvc\Controller;
use Asa\Erp\DdOrder;
/**
 * 订单主表
 */
class OrderController extends BaseController
{
    protected $permission_msg;
    public function initialize()
    {
        parent::initialize();
        // 权限提示
        $this->permission_msg = $this->getValidateMessage('order-gurd-alert-message');
    }
    public function pageAction() {
        $result = DdOrder::find(
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
            // 查找订单号是否存在或者非法
            // 只有status=1的订单才可以修改
            $order = DdOrder::findFirst(
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
        }
        else {
            // 没有订单号就新增
            $order = new DdOrder();
            foreach ($submitData['form'] as $k => $item) {
                $order->$k = $item;
            }
            // 添加制单人及制单日期
            $order->makestaff = $this->currentUser;
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
            if ($detailRet===false) {
                $this->db->rollback();
                $msg = $this->getValidateMessage('orderdetail', 'db', 'add-failed');
                return $this->error([$msg]);
            }
            $detail_id_array[] = $detailRet->id;
        }
        //清除不存在的详情id
        if(count($detail_id_array)>0) {
            $details = DdOrderdetails::find(
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
        $order = DdOrder::findFirst(
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
        $order = DdOrder::findFirst(
            sprintf("id=%d and companyid=%d", $_GET["id"], $this->companyid)
        );
        // 判断订单是否存在
        if ($order!=false && $order->status!=1) {
            $this->doTableAction($order,"delete");
        }
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
            $this->doTableAction($order,"update");
        }
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
            $this->doTableAction($order,"update");
        }
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
            $this->doTableAction($order,"update");
        }
    }
    /**
     * 订单修改,订单提交审核之后，只能修改部分字段信息
     * @return [type] [description]
     */
    public function modifyAction() {
        $orderid = (int)$_POST['id'];
        // 根据orderid查询出当前订单以及订单详情的所有信息
        $order = DdOrder::findFirstById($orderid);
        if($order!=false && $order->companyid==$this->companyid) {
            //定义可以修改的字段名
            $columns = array();
            //如果需求需要，可以在这里比较修改前后的数据变化，并留痕
            //如果不需要，直接按照定义的字段范围更新数据
            $this->doTableAction($order,"update");
        }
    }
}