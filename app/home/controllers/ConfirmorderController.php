<?php

namespace Multiple\Home\Controllers;

use Asa\Erp\DdConfirmorderdetails;
use Asa\Erp\DdOrderdetails;
use Asa\Erp\TbProduct;
use Phalcon\Mvc\Controller;
use Phalcon\Mvc\View;
use Asa\Erp\DdConfirmorder;
use Asa\Erp\DdOrder;
use Phalcon\Filter;
use Asa\Erp\TbCompany;
use Asa\Erp\Util;

/**
 * 发货单主表
 */
class ConfirmorderController extends CadminController {

    // 发货单参数
    protected $confirmorderParams;
    // 发货单id
    protected $confirmorderid;
    // 当前用户
    protected $userid;
    // 权限提示msg
    protected $permission_msg;
    // 商品列表
    protected $productlist;

    /**
     * 初始化
     */
    public function initialize() {
        parent::initialize();

        $this->setModelName('Asa\\Erp\\DdConfirmorder');

        // 当前用户
        $this->userid = $this->auth['id'];

        // 权限提示
        $this->permission_msg = $this->getValidateMessage('confirmorder-gurd-alert-message');

        // 商品列表
        $this->productlist = [];
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

        // 获取查询条件，如果直接通过post传值，在地址栏接收的话，用这个逻辑
        $formdata = $this->request->get();
        // 清除冗余的_url字段
        unset($formdata['_url']);

        // 开始判断
        // 初始化一个值用来保存查询的条件
        $wherelist = [];
        // 过滤数据
        $filter = new Filter();
        if(isset($formdata['supplierid']) && $formdata['supplierid']) {
            $supplierid = $filter->sanitize($formdata['supplierid'], "int");
            if ($supplierid) {
                $wherelist[] = 'supplierid = ' . $supplierid;
            }
        }
        if(isset($formdata['ageseason']) && $formdata['ageseason']) {
            $ageseason = $filter->sanitize($formdata['ageseason'], "int");
            if ($ageseason) {
                $wherelist[] = 'ageseason = ' . $ageseason;
            }
        }
        // 组装查询条件，并用AND连接起来
        // 还要加上不能删除
        if(count($wherelist) > 0){
            $where = " sys_delete_flag = 0 AND ".implode(' AND ' , $wherelist);
        } else {
            $where = "sys_delete_flag = 0";
        }

        // 开始查询，可能会查询到多条发货单，再根据每条发货单去查询当前记录的详情列表
        $orders = DdOrder::find($where);
        $orderdetails = [];
        // 接着查找当前发货单下面的所有代发货的发货单详情，并用列表的形式展示出来
        foreach ($orders as $order) {
            foreach ($order->orderdetails as $orderdetail) {
                // 过滤掉已删除数据和已经发完货的数据
                if (($orderdetail->sys_delete_flag == '0' && ($orderdetail->number > $orderdetail->actualnumber))) {
                    // 增加一个允许最大发货数量allownumber字段，其实就是$orderdetail->number - $orderdetail->actualnumber的值，只是为了前台调用更加方便而已
                    $orderdetail_arr = $orderdetail->toArray();
                    $orderdetail_arr['allownumber'] = $orderdetail->number - $orderdetail->actualnumber;
                    // 可能记录有很多重复的商品数据，这时候先只取出productid，再去重
                    $this->productlist[] = $orderdetail->product->id;
                    $orderdetails[] = $orderdetail_arr;
                }
            }
        }

        // 组装
        $this->confirmorderParams['list'] = $orderdetails;
        $this->confirmorderParams['productlist'] = array_values(array_unique($this->productlist));
        // 最后再取出product模型
        foreach ($this->confirmorderParams['productlist'] as $k => $productid) {
            $this->confirmorderParams['productlist'][$k] = TbProduct::findFirstById($productid)->toArray();
        }
        // 返回数据
        return $this->success($this->confirmorderParams);
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
        $arr = json_decode($params, true);
        $this->confirmorderParams = $arr;

        // 判断是否有发货单号，分别进行
        $this->confirmorderid = $this->confirmorderParams['form']['id'];

        // 判断逻辑
        if ($this->confirmorderid) {
            // 有发货单号就修改
            // 查找发货单号是否存在
            $confirmorder = DdConfirmorder::findFirstById($this->confirmorderid);
            if (!$confirmorder) {
                $msg = $this->getValidateMessage('confirmorder', 'template', 'notexist');
                return $this->error([$msg]);
            }

            // 判断当前发货单是否属于当前用户所在公司
            if (!$this->check_if_self_company_order($confirmorder->companyid)) {
                return $this->error([$this->permission_msg]);
            }

            // 采用事务处理
            $this->db->begin();

            // 开始更新
            foreach ($this->confirmorderParams['form'] as $k => $item) {
                // 把里面的参数转成post参数传递过去
                if (isset($item)) {
                    $_POST[$k] = $item;
                }

                // 时间类型如果为空，设置为null
                if (!isset($_POST["flightdate"]) || $_POST["flightdate"] == "") {
                    $_POST["flightdate"] = NULL;
                }
                if (!isset($_POST["paydate"]) || $_POST["paydate"] == "") {
                    $_POST["paydate"] = NULL;
                }
                if (!isset($_POST["apickingdate"]) || $_POST["apickingdate"] == "") {
                    $_POST["apickingdate"] = NULL;
                }
                if (!isset($_POST["aarrivaldate"]) || $_POST["aarrivaldate"] == "") {
                    $_POST["aarrivaldate"] = NULL;
                }
            }

            // 判断是否成功
            if (!$confirmorder->save($_POST)) {
                $this->db->rollback();
                // 验证类错误给出提示
                $messages = $confirmorder->getMessages();
                foreach ($messages as $message) {
                    $result[] = $message->getMessage();
                }
                return $this->error($result);
            }

            // 开始更新发货单详情表
            // 首先删除原纪录
            foreach ($confirmorder->confirmorderdetails as $confirmorderdetail) {
                if (!$confirmorderdetail->delete()) {
                    $this->db->rollback();
                    $msg = $this->getValidateMessage('confirmorder', 'db', 'delete-failed');
                    return $this->error([$msg]);
                }
            }

            // 开始写入发货单详情表
            // 然后新增发货单详情
            // 封装的过程中如果操作失败会回滚，所以放弃了封装，直接放在这里显示
            foreach ($this->confirmorderParams['list'] as $k => $item) {
                if (isset($item)) {
                    $_POST = $item;
                    // 加入发货单ID
                    $_POST['confirmorderid'] = $this->confirmorderid;
                }

                // 判断接收的参数是否正常
                // 首先是键名是否存在
                if (
                    !array_key_exists('productid', $_POST) ||
                    !array_key_exists('sizecontentid', $_POST) ||
                    !array_key_exists('number', $_POST) ||
                    !array_key_exists('orderdetailsid', $_POST) ||
                    !array_key_exists('confirmorderid', $_POST)
                ) {
                    $this->db->rollback();
                    $msg = $this->getValidateMessage('confirmorderdetail', 'db', 'add-failed');
                    return $this->error([$msg]);
                }

                // 其次是键值是否正常
                if (
                    !$_POST['productid'] ||
                    !$_POST['sizecontentid'] ||
                    !$_POST['number'] ||
                    !$_POST['orderdetailsid'] ||
                    !$_POST['confirmorderid']
                ) {
                    $this->db->rollback();
                    $msg = $this->getValidateMessage('confirmorderdetail', 'db', 'add-failed');
                    return $this->error([$msg]);
                }

                // 使用模型更新
                $confirmorderDetail = new DdConfirmorderdetails();
                $data = [
                    'productid' => $_POST['productid'],
                    'sizecontentid' => $_POST['sizecontentid'],
                    'orderdetailsid' => $_POST['orderdetailsid'],
                    'number' => $_POST['number'],
                    'confirmorderid' => $_POST['confirmorderid'],
                ];
                if (!$confirmorderDetail->save($data)) {
                    $this->db->rollback();
                    $msg = $this->getValidateMessage('confirmorderdetail', 'db', 'add-failed');
                    return $this->error([$msg]);
                }
                // 订单详情页面发货数量更新
                $orderdetail = DdOrderdetails::findFirstById($_POST['orderdetailsid']);
                if (!$orderdetail) {
                    $this->db->rollback();
                    $msg = $this->getValidateMessage('orderdetail', 'db', 'add-failed');
                    return $this->error([$msg]);
                }
                // 发货数量不能大于之前的订单量，否则报错
                if ($orderdetail->actualnumber + $_POST['number'] > $orderdetail->number) {
                    $this->db->rollback();
                    $msg = $this->getValidateMessage('orderdetail-over-max-number');
                    return $this->error([$msg]);
                }
                // // 判断是否写入成功，这里相当于只是放入了购物车，库存没有任何变化，所以不需要写入，只有审核了之后才写到orderdetail表里
                // if (!$orderdetail->save(['actualnumber' => $orderdetail->actualnumber+$_POST['number']])) {
                //     $this->db->rollback();
                //     $msg = $this->getValidateMessage('orderdetail', 'db', 'add-failed');
                //     return $this->error([$msg]);
                // }
            }

            // 提交事务
            $this->db->commit();

        } else {
            // 没有发货单号就新增
            // 采用事务处理
            $this->db->begin();
            // 把执行结果放在缓冲区，然后取出来
            ob_start();
            $this->doAdd();
            $confirmorder = ob_get_contents();
            ob_end_clean();

            // 转成数组
            $order_arr = json_decode($confirmorder, true);

            // 判断是否更新成功，加入是否为数组的判断
            if (is_array($order_arr) && array_key_exists('messages', $order_arr) && count($order_arr['messages']) > 0) {
                $this->db->rollback();
                // 取出错误记录，因为在模型验证的时候，基本上都是出现错误就停止继续运行，所以只取出一条记录即可。
                return $this->error([$order_arr['messages'][0]]);
            }

            // 取出发货单id
            $this->confirmorderid = $order_arr['id'];

            // 开始写入发货单详情表
            // 然后新增发货单详情
            // 封装的过程中如果操作失败会回滚，所以放弃了封装，直接放在这里显示
            foreach ($this->confirmorderParams['list'] as $k => $item) {
                if (isset($item)) {
                    $_POST = $item;
                    // 加入发货单ID
                    $_POST['confirmorderid'] = $this->confirmorderid;
                }

                // 判断接收的参数是否正常
                // 首先是键名是否存在
                if (
                    !array_key_exists('productid', $_POST) ||
                    !array_key_exists('sizecontentid', $_POST) ||
                    !array_key_exists('number', $_POST) ||
                    !array_key_exists('orderdetailsid', $_POST) ||
                    !array_key_exists('confirmorderid', $_POST)
                ) {
                    $this->db->rollback();
                    $msg = $this->getValidateMessage('confirmorderdetail', 'db', 'add-failed');
                    return $this->error([$msg]);
                }

                // 其次是键值是否正常
                if (
                    !$_POST['productid'] ||
                    !$_POST['sizecontentid'] ||
                    !$_POST['number'] ||
                    !$_POST['orderdetailsid'] ||
                    !$_POST['confirmorderid']
                ) {
                    $this->db->rollback();
                    $msg = $this->getValidateMessage('confirmorderdetail', 'db', 'add-failed');
                    return $this->error([$msg]);
                }

                // 使用模型更新
                $confirmorderDetail = new DdConfirmorderdetails();
                $data = [
                    'productid' => $_POST['productid'],
                    'sizecontentid' => $_POST['sizecontentid'],
                    'orderdetailsid' => $_POST['orderdetailsid'],
                    'number' => $_POST['number'],
                    'confirmorderid' => $_POST['confirmorderid'],
                ];
                if (!$confirmorderDetail->save($data)) {
                    $this->db->rollback();
                    $msg = $this->getValidateMessage('confirmorderdetail', 'db', 'add-failed');
                    return $this->error([$msg]);
                }
                // 订单详情页面发货数量更新
                $orderdetail = DdOrderdetails::findFirstById($_POST['orderdetailsid']);
                if (!$orderdetail) {
                    $this->db->rollback();
                    $msg = $this->getValidateMessage('orderdetail', 'db', 'add-failed');
                    return $this->error([$msg]);
                }
                // 发货数量不能大于之前的订单量，否则报错
                if ($orderdetail->actualnumber + $_POST['number'] > $orderdetail->number) {
                    $this->db->rollback();
                    $msg = $this->getValidateMessage('orderdetail-over-max-number');
                    return $this->error([$msg]);
                }
                // // 判断是否写入成功，这里相当于只是放入了购物车，库存没有任何变化，所以不需要写入，只有审核了之后才写到orderdetail表里
                // if (!$orderdetail->save(['actualnumber' => $orderdetail->actualnumber+$_POST['number']])) {
                //     $this->db->rollback();
                //     $msg = $this->getValidateMessage('orderdetail', 'db', 'add-failed');
                //     return $this->error([$msg]);
                // }
            }

            // 提交事务
            $this->db->commit();
        }

        // 取出单个模型及发货单详情逻辑
        $this->getConfirmorder($this->confirmorderid);
    }

    /**
     * 读取发货单信息，必须传一个id参数，代表发货单编号
     * @return false|string
     */
    public function loadorderAction()
    {
        // 必须传递一个订单id
        if (!$this->request->get('id')) {
            $msg = $this->getValidateMessage('confirmorderid', 'template', 'required');
            return $this->error([$msg]);
        }
        $this->confirmorderid = $this->request->get('id');
        // 取出单个模型及发货单详情逻辑
        $this->getConfirmorder($this->confirmorderid);
    }

    /**
     * 重写，添加发货单号以及其他必要的参数
     */
    public function doAdd()
    {
        if ($this->request->isPost()) {
            // 更新数据库
            // 开始解析参数，转化成直接post请求
            foreach ($this->confirmorderParams['form'] as $k => $item) {
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
            // 时间类型如果为空，设置为null
            if (!isset($_POST["flightdate"]) || $_POST["flightdate"] == "") {
                $_POST["flightdate"] = NULL;
            }
            if (!isset($_POST["paydate"]) || $_POST["paydate"] == "") {
                $_POST["paydate"] = NULL;
            }
            if (!isset($_POST["apickingdate"]) || $_POST["apickingdate"] == "") {
                $_POST["apickingdate"] = NULL;
            }
            if (!isset($_POST["aarrivaldate"]) || $_POST["aarrivaldate"] == "") {
                $_POST["aarrivaldate"] = NULL;
            }
            // 生成主单号
            $company_rand = TbCompany::findFirstById($this->companyid)->randid;
            // 开始处理随机数，保存成6位数字
            $company_rand = Util::cover_position($company_rand, 6);
            $orderno = 'C' . $company_rand . date('YmdHis') . mt_rand(1000, 9999);
            if (!isset($_POST["mblno"]) || $_POST["mblno"] == "") {
                $_POST["orderno"] = $orderno;
            }

            // 继续执行父类其他方法
            parent::doAdd();
        }
    }

    /**
     * 判断当前发货单是否属于当前用户所在公司
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
     * 根据发货单id查询出每个发货单下面的模型和具体发货单详情
     * @param $confirmorderid 发货单id
     * @return false|string
     */
    public function getConfirmorder($confirmorderid)
    {
        // 根据orderid查询出当前发货单以及发货单详情的所有信息
        $confirmorder = DdConfirmorder::findFirstById($confirmorderid);
        // 判断发货单是否存在
        if (!$confirmorder) {
            $msg = $this->getValidateMessage('confirmorderdetail', 'template', 'notexist');
            echo $this->error([$msg]);
            exit;
        }
        // 清除原来的list节点和form节点
        unset($this->confirmorderParams['form']);
        unset($this->confirmorderParams['list']);
        // 添加form节点
        $this->confirmorderParams['form'] = $confirmorder->toArray();
        // 循环添加数据
        foreach ($confirmorder->confirmorderdetails as $k => $confirmorderdetail) {
            // 过滤已经删除的数据
            if ($confirmorderdetail->sys_delete_flag == '0') {
                $confirmorderdetail_array = $confirmorderdetail->toArray();
                // 添加该商品的orderdetail信息
                $confirmorderdetail_array['orderdetails'] = $confirmorderdetail->orderdetails->toArray();
                // 可能记录有很多重复的商品数据，这时候先只取出productid，再去重
                $this->productlist[] = $confirmorderdetail->product->id;
                $this->confirmorderParams['list'][] = $confirmorderdetail_array;
            }
        }
        // 组装
        $this->confirmorderParams['productlist'] = array_values(array_unique($this->productlist));
        // 最后再取出product模型
        foreach ($this->confirmorderParams['productlist'] as $k => $productid) {
            $this->confirmorderParams['productlist'][$k] = TbProduct::findFirstById($productid)->toArray();
        }
        // 最终成功返回，原来的数据还要保留，再加上发货单详情之中每个商品的名称也要放进去
        echo $this->success($this->confirmorderParams);
    }

}
