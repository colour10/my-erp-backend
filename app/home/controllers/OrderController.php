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
    // 订单对比临时变量
    protected $orderlist;

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

        // 订单对比临时变量
        $this->orderlist = [];
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
        $arr = json_decode($params, true);
        $this->orderParams = $arr;

        // 订单主表中，开始验证必填字段
        // 年代id、供货商id为必填项

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
                $msg = $this->getValidateMessage('order', 'template', 'notexist');
                return $this->error([$msg]);
            }

            // 判断当前订单是否属于当前用户所在公司
            if (!$this->check_if_self_company_order($order->companyid)) {
                return $this->error([$this->permission_msg]);
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
                // 验证类错误给出提示
                $messages = $order->getMessages();
                foreach ($messages as $message) {
                    $result[] = $message->getMessage();
                }
                return $this->error($result);
            }

            // 之前先软删除所有的关联表记录，如果遇到操作记录比较多的时候，可能会添加过多的记录；再比如如果添加的次数比较多可能数据量比较大，所以改用操作差集，有新纪录就删除，所以下面的逻辑暂时作废，如果有需要再重新启动
            // // 开始更新订单详情表
            // // 首先删除原纪录
            // foreach ($order->orderdetails as $orderdetail) {
            //     if (!$orderdetail->delete()) {
            //         $this->db->rollback();
            //         $msg = $this->getValidateMessage('order', 'db', 'delete-failed');
            //         return $this->error([$msg]);
            //     }
            // }

            // 用一个old数组用来保存原来的记录id列表
            foreach ($order->orderdetails as $orderdetail) {
                // 找出原来记录的id号，并记录下来
                // 但是要先过滤掉已经删除的
                if ($orderdetail->sys_delete_flag == '0') {
                    $this->orderlist['old'][] = $orderdetail->id;
                }
            }

            // 用一个新数组保留新添加的id列表
            // 如果id为空，那么就说明是新添加的记录
            foreach ($this->orderParams['list'] as $k => $item) {
                if (isset($item['id'])) {
                    $this->orderlist['new'][] = $item['id'];
                }
            }

            // 然后分别找出两个记录集的差集和交集，一共需要找出3条记录，分别是：
            // 只在旧记录中存在的，这部分只需要直接删除即可
            $this->orderlist['old_diff'] = array_values(array_diff($this->orderlist['old'], $this->orderlist['new']));
            // 两者都有的，也就是交集，这部分需要做更新操作
            $this->orderlist['old_new_intersect'] = array_intersect($this->orderlist['old'], $this->orderlist['new']);
            // 只在新纪录中存在的，这部分需要做新增操作
            $this->orderlist['new_diff'] = array_values(array_diff($this->orderlist['new'], $this->orderlist['old']));

            // 开始做真正的操作
            // 第1步，删除old_diff
            foreach ($this->orderlist['old_diff'] as $orderdetailid) {
                // 先判断订单详情表是否存在
                $orderdetail = DdOrderdetails::findFirstById($orderdetailid);
                if (!$orderdetail) {
                    $this->db->rollback();
                    $msg = $this->getValidateMessage('orderdetail', 'template', 'notexist');
                    return $this->error([$msg]);
                }
                if (!$orderdetail->delete()) {
                    $this->db->rollback();
                    $msg = $this->getValidateMessage('orderdetail', 'db', 'delete-failed');
                    return $this->error([$msg]);
                }
            }

            // 第2步,更新old_new_intersect交集，因为ajax已经在list数组中传过来了数据，所以把这部分重新赋值给post即可
            foreach ($this->orderlist['old_new_intersect'] as $orderdetailid) {
                foreach ($this->orderParams['list'] as $item) {
                    // 首先找到和list匹配的记录
                    if ($item['id'] == $orderdetailid) {
                        $_POST = $item;
                        // 开始修改
                        $orderdetail = DdOrderdetails::findFirstById($orderdetailid);
                        if (!$orderdetail) {
                            $this->db->rollback();
                            $msg = $this->getValidateMessage('orderdetail', 'template', 'notexist');
                            return $this->error([$msg]);
                        }
                        $data = [
                            'productid' => $_POST['productid'],
                            'sizecontentid' => $_POST['sizecontentid'],
                            'number' => $_POST['number'],
                        ];
                        if (!$orderdetail->save($data)) {
                            $this->db->rollback();
                            // 返回错误信息
                            $messages = $orderdetail->getMessages();
                            foreach ($messages as $message) {
                                $result[] = $message->getMessage();
                            }
                            return $this->error($result);
                        }
                    }
                }
            }

            // 第3步，新增记录，直接新增即可，但是要在list列表中过滤掉ID为非空的数据，因为id为非空的肯定是不隶属于当前orderid的订单的，必定不符合要求
            foreach ($this->orderParams['list'] as $item) {
                if (!$item['id']) {
                    $_POST = $item;
                    // 加入订单
                    $_POST['orderid'] = $this->orderid;

                    // 新增逻辑
                    $orderdetail = new DdOrderdetails();
                    $data = [
                        'productid' => $_POST['productid'],
                        'sizecontentid' => $_POST['sizecontentid'],
                        'number' => $_POST['number'],
                        'companyid' => $this->companyid,
                        'orderid' => $_POST['orderid'],
                    ];
                    if (!$orderdetail->save($data)) {
                        $this->db->rollback();
                        // 返回错误信息
                        $messages = $orderdetail->getMessages();
                        foreach ($messages as $message) {
                            $result[] = $message->getMessage();
                        }
                        return $this->error($result);
                    }
                }
            }

            // 下面是之前的订单详情表更新逻辑，已经作废，有需要再开启
            // // 开始写入订单详情表
            // // 封装的过程中如果操作失败会回滚，所以放弃了封装，直接放在这里显示
            // foreach ($this->orderParams['list'] as $k => $item) {
            //     if (isset($item)) {
            //         $_POST = $item;
            //         // 加入订单
            //         $_POST['orderid'] = $this->orderid;
            //     }
            //
            //     // 判断接收的参数是否正常
            //     // 首先是键名是否存在
            //     if (
            //         !array_key_exists('productid', $_POST) ||
            //         !array_key_exists('sizecontentid', $_POST) ||
            //         !array_key_exists('number', $_POST) ||
            //         !array_key_exists('orderid', $_POST)
            //     ) {
            //         $this->db->rollback();
            //         $msg = $this->getValidateMessage('orderdetail', 'db', 'add-failed');
            //         return $this->error([$msg]);
            //     }
            //
            //     // 其次是键值是否正常
            //     if (
            //         !$_POST['productid'] ||
            //         !$_POST['sizecontentid'] ||
            //         !$_POST['number'] ||
            //         !$_POST['orderid']
            //     ) {
            //         $this->db->rollback();
            //         $msg = $this->getValidateMessage('orderdetail', 'db', 'add-failed');
            //         return $this->error([$msg]);
            //     }
            //
            //     // 使用模型更新
            //     $orderdetail = new DdOrderdetails();
            //     $data = [
            //         'productid' => $_POST['productid'],
            //         'sizecontentid' => $_POST['sizecontentid'],
            //         'number' => $_POST['number'],
            //         'companyid' => $this->companyid,
            //         'orderid' => $_POST['orderid'],
            //     ];
            //     if (!$orderdetail->save($data)) {
            //         $this->db->rollback();
            //         $msg = $this->getValidateMessage('orderdetail', 'db', 'add-failed');
            //         return $this->error([$msg]);
            //     }
            // }

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

            // 判断是否更新成功，加入是否为数组的判断
            if (is_array($order_arr) && array_key_exists('messages', $order_arr) && count($order_arr['messages']) > 0) {
                $this->db->rollback();
                // 取出错误记录，因为在模型验证的时候，基本上都是出现错误就停止继续运行，所以只取出一条记录即可。
                return $this->error([$order_arr['messages'][0]]);
            }

            // 取出订单id
            $this->orderid = $order_arr['id'];

            // 开始写入订单详情表
            // 封装的过程中如果操作失败会回滚，所以放弃了封装，直接放在这里显示
            foreach ($this->orderParams['list'] as $k => $item) {
                if (isset($item)) {
                    $_POST = $item;
                    // 加入订单
                    $_POST['orderid'] = $this->orderid;
                }

                // 判断接收的参数是否正常
                // 首先是键名是否存在
                if (
                    !array_key_exists('productid', $_POST) ||
                    !array_key_exists('sizecontentid', $_POST) ||
                    !array_key_exists('number', $_POST) ||
                    !array_key_exists('orderid', $_POST)
                ) {
                    $this->db->rollback();
                    $msg = $this->getValidateMessage('orderdetail', 'db', 'add-failed');
                    return $this->error([$msg]);
                }

                // 其次是键值是否正常
                if (
                    !$_POST['productid'] ||
                    !$_POST['sizecontentid'] ||
                    !$_POST['number'] ||
                    !$_POST['orderid']
                ) {
                    $this->db->rollback();
                    $msg = $this->getValidateMessage('orderdetail', 'db', 'add-failed');
                    return $this->error([$msg]);
                }

                // 使用模型更新
                $orderdetail = new DdOrderdetails();
                $data = [
                    'productid' => $_POST['productid'],
                    'sizecontentid' => $_POST['sizecontentid'],
                    'number' => $_POST['number'],
                    'companyid' => $this->companyid,
                    'orderid' => $_POST['orderid'],
                ];
                if (!$orderdetail->save($data)) {
                    $this->db->rollback();
                    $msg = $this->getValidateMessage('orderdetail', 'db', 'add-failed');
                    return $this->error([$msg]);
                }
            }

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
            $msg = $this->getValidateMessage('order', 'template', 'required');
            return $this->error([$msg]);
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
            // 开始解析参数，转化成直接post请求
            foreach ($this->orderParams['form'] as $k => $item) {
                if (isset($item)) {
                    $_POST[$k] = $item;
                }
            }
            // 部分数据重写
            // 添加制单人及制单日期
            if (!isset($_POST["makestaff"]) || $_POST["makestaff"] == "") {
                $_POST["makestaff"] = $this->userid;
            }
            if (!isset($_POST["makedate"]) || $_POST["makedate"] == "") {
                $_POST["makedate"] = date('Y-m-d H:i:s');
            }
            // 生成订单号
            $company_rand = TbCompany::findFirstById($this->companyid)->randid;
            // 开始处理随机数，保存成6位数字
            $company_rand = Util::cover_position($company_rand, 6);
            $orderno = 'D' . $company_rand . date('YmdHis') . mt_rand(1000, 9999);
            if (!isset($_POST["orderno"]) || $_POST["orderno"] == "") {
                $_POST["orderno"] = $orderno;
            }

            // 继续执行父类其他方法
            parent::doAdd();
        }
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
    //         $orderdetail = new DdOrderdetails();
    //         $data = [
    //             'productid' => $_POST['productid'],
    //             'sizecontentid' => $_POST['sizecontentid'],
    //             'number' => $_POST['number'],
    //             'companyid' => $this->companyid,
    //             'orderid' => $_POST['orderid'],
    //         ];
    //         if (!$orderdetail->save($data)) {
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
        // 清除原来的list节点和form节点
        unset($this->orderParams['form']);
        unset($this->orderParams['list']);
        // 添加form节点
        $this->orderParams['form'] = $order->toArray();
        // 循环添加数据
        foreach ($order->orderdetails as $k => $orderdetail) {
            // 过滤已经删除的数据
            if ($orderdetail->sys_delete_flag == '0') {
                $orderdetail_array = $orderdetail->toArray();
                $orderdetail_array['product'] = $orderdetail->product->toArray();
                $this->orderParams['list'][] = $orderdetail_array;
            }
        }
        // 最终成功返回，原来的数据还要保留，再加上订单详情之中每个商品的名称也要放进去
        echo $this->success($this->orderParams);
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

}
