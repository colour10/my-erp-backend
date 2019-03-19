<?php

namespace Multiple\Home\Controllers;

use Asa\Erp\DdOrderdetails;
use Asa\Erp\TbCompany;
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
    // 字段名称
    protected $zlcontent_field_name;

    public function initialize()
    {
        parent::initialize();

        $this->setModelName('Asa\\Erp\\DdOrder');

        // 确定字段名称
        // 拿到当前尺码字段名称
        $zlcontent = new ZlSizecontent();
        $this->zlcontent_field_name = $zlcontent->getColumnName('content');
    }

    /**
     * 订单保存
     */
    public function saveorderAction()
    {
        // 判断是否有params参数提交过来
        $params = $this->request->get('params');
        if (!$params) {
            return $this->error(['params is required']);
        }
        // 转换成数组
        $arr = json_decode($params, true);
        $this->orderParams = $arr;

        // // 判断订单是否有数据
        // // 订单数据可以为空，暂时注释
        // if (count($this->orderParams['list']) == '0') {
        //     return $this->error(['order list is empty']);
        // }

        // 判断是否有订单号，分别进行
        $this->orderid = $this->orderParams['form']['id'];
        // 判断逻辑
        if ($this->orderid) {
            // 有订单号就修改
            // 查找订单号是否存在
            $order = DdOrder::findFirstById($this->orderid);
            if (!$order) {
                return $this->error(['order does not exist']);
            }

            // 采用事务处理
            $this->db->begin();

            // 开始更新
            foreach ($this->orderParams['form'] as $k => $item) {
                // 把里面的参数转成post参数传递过去
                if (isset($item)) {
                    $_POST[$k] = $item;
                }
            }

            // 判断是否成功
            if (!$order->save($_POST)) {
                $this->db->rollback();
                return $this->error(['order save failed']);
            }

            // 开始更新订单详情表
            // 首先删除原纪录
            foreach ($order->orderdetails as $orderdetail) {
                if (!$orderdetail->delete()) {
                    $this->db->rollback();
                    return $this->error(['order delete failed']);
                }
            }

            // 然后新增订单详情
            $this->addOrderDetail();

            // 提交事务
            $this->db->commit();

        } else {
            // 没有订单号就新增
            // 采用事务处理
            $this->db->begin();
            // 把执行结果放在缓冲区，然后取出来
            ob_start();
            $this->doAdd();
            $order = ob_get_contents();
            ob_end_clean();

            // 转成数组
            $order_arr = json_decode($order, true);

            // 判断是否更新成功
            if (array_key_exists('messages', $order_arr) && count($order_arr['messages']) > 0) {
                $this->db->rollback();
                // 取出错误记录，因为在模型验证的时候，基本上都是出现错误就停止继续运行，所以只取出一条记录即可。
                return $this->error([$order_arr['messages'][0]]);
            }

            // 取出订单id
            $this->orderid = $order_arr['id'];

            // 开始写入订单详情表
            // 需要引入订单详情表模型
            $this->addOrderDetail();

            // 提交事务
            $this->db->commit();
        }

        // 取出单个模型及下级订单详情逻辑
        $this->getOrder($this->orderid);
    }


    /**
     * 读取订单信息，必须传一个id参数，代表订单编号
     * @return false|string
     */
    public function loadorderAction()
    {
        // 必须传递一个订单id
        if (!$this->request->get('id')) {
            return $this->error(['order id is required']);
        }
        $this->orderid = $this->request->get('id');
        // 取出单个模型及下级订单详情逻辑
        $this->getOrder($this->orderid);
    }

    /**
     * 重写，添加订单号以及其他必要的参数
     */
    public function doAdd()
    {
        if ($this->request->isPost()) {
            // 更新数据库
            // 生成订单号
            $company_rand = TbCompany::findFirstById($this->companyid)->randid;
            $orderno = 'D' . $company_rand . date('YmdHis') . mt_rand(10000000, 99999999);
            if (!isset($_POST["orderno"]) || $_POST["orderno"] == "") {
                $_POST["orderno"] = $orderno;
            }
            // 开始解析参数，转化成直接post请求
            foreach ($this->orderParams['form'] as $k => $item) {
                if (isset($item)) {
                    $_POST[$k] = $item;
                }
            }

            // 继续执行父类其他方法
            parent::doAdd();
        }
    }

    /**
     * 订单详情表分功能，内嵌共通
     */
    private function addOrderDetail()
    {
        foreach ($this->orderParams['list'] as $k => $item) {
            if (isset($item)) {
                $_POST = $item;
                // 加入订单
                $_POST['orderid'] = $this->orderid;
            }

            // 使用模型更新
            $orderDetail = new DdOrderdetails();
            $data = [
                'productid' => $_POST['productid'],
                'sizecontentid' => $_POST['sizecontentid'],
                'number' => $_POST['number'],
                'companyid' => $this->companyid,
                'orderid' => $_POST['orderid'],
            ];
            if (!$orderDetail->save($data)) {
                $this->db->rollback();
                return $this->error(['orderdetail insert failed']);
            }
        }
    }


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
            echo $this->error(['order does not exist']);
            exit;
        }
        // 清除原来的list节点和form节点
        unset($this->orderParams['form']);
        unset($this->orderParams['list']);
        // 添加form节点
        $this->orderParams['form'] = $order->toArray();
        // 循环添加数据
        foreach ($order->orderdetails as $k => $orderdetail) {
            if ($orderdetail->sys_delete_flag == '0') {
                $this->orderParams['list'][] = [
                    'id' => $orderdetail->id,
                    'productid' => $orderdetail->productid,
                    'sizecontentid' => $orderdetail->sizecontentid,
                    'number' => $orderdetail->number,
                    'productname' => $orderdetail->product->productname,
                    'sizecontentname' => $orderdetail->sizecontent->{$this->zlcontent_field_name},
                ];
            }
        }
        // 最终成功返回，原来的数据还要保留，再加上订单详情之中每个商品的名称也要放进去
        echo json_encode(['code' => '200', 'messages' => [], 'data' => $this->orderParams]);
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
            return $this->error(['order id is required']);
        }
        $this->orderid = $this->request->get('id');
        // 根据orderid查询出当前订单以及订单详情的所有信息
        $order = DdOrder::findFirstById($this->orderid);
        // 判断订单是否存在
        if (!$order) {
            return $this->error(['order does not exist']);
        }
        parent::deleteAction();
    }
}
