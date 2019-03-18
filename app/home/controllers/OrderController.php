<?php

namespace Multiple\Home\Controllers;

use Asa\Erp\TbCompany;
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

    public function initialize()
    {
        parent::initialize();

        $this->setModelName('Asa\\Erp\\DdOrder');
    }

    /**
     * 订单保存
     */
    public function saveorderAction()
    {
        // 判断是否提交
        $params = $this->request->get('params');
        if (!$params) {
            return $this->error(['data error']);
        }
        // 转换成数组
        $arr = json_decode($params, true);
        $this->orderParams = $arr;

        // 判断订单是否有数据
        if (count($this->orderParams['list']) == '0') {
            return $this->error(['order list is empty']);
        }
        // 判断是否有订单号，分别进行
        if ($this->orderParams['form']['id']) {
            // 有订单号就修改
        } else {
            // 没有订单号就新增
            $order = $this->doAdd();
            return $order;
            exit;
        }
        return $this->success();
    }

    /**
     * 读取订单
     */
    public function loadorderAction()
    {
        echo 'loadorder';
        exit;
    }

    /**
     * 重写，添加订单号以及其他必要的参数
     */
    public function doAdd()
    {
        if ($this->request->isPost()) {
            // 更新数据库
            // 生成订单号
            $company_rand = TbCompany::findFirstById($this->session->get('user')['companyid'])->randid;
            $orderid = 'D' . $company_rand . date('YmdHis') . mt_rand(10000000, 99999999);
            if (!isset($_POST["orderid"]) || $_POST["orderid"] == "") {
                $_POST["orderid"] = $orderid;
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
}
