<?php

namespace Multiple\Home\Controllers;

use Phalcon\Mvc\Controller;
use Phalcon\Mvc\View;
use Asa\Erp\XsSales;
use Asa\Erp\TbCompany;
use Asa\Erp\Util;
use Asa\Erp\XsSalesdetails;

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

        $this->setModelName('Asa\\Erp\\XsSales');

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
        $arr = json_decode($params, true);
        $this->saleParams = $arr;

        // // 判断销售单是否有数据
        // // 销售单数据可以为空，暂时注释
        // if (count($this->saleParams['list']) == '0') {
        //     return $this->error(['sale list is empty']);
        // }

        // 判断是否有销售单号，分别进行
        $this->salesid = $this->saleParams['form']['id'];
        // 判断逻辑
        if ($this->salesid) {
            // 有销售单号就修改
            // 查找销售单号是否存在
            $sale = XsSales::findFirstById($this->salesid);
            if (!$sale) {
                $msg = $this->getValidateMessage('sale', 'template', 'notexist');
                return $this->error([$msg]);
            }

            // 采用事务处理
            $this->db->begin();

            // 开始更新
            foreach ($this->saleParams['form'] as $k => $item) {
                // 把里面的参数转成post参数传递过去
                if (isset($item)) {
                    $_POST[$k] = $item;
                }
            }

            // 判断是否成功
            if (!$sale->save($_POST)) {
                $this->db->rollback();
                $msg = $this->getValidateMessage('sale', 'db', 'save-failed');
                return $this->error([$msg]);
            }

            // 开始更新销售单详情表
            // 首先删除原纪录
            foreach ($sale->salesdetails as $salesdetail) {
                if (!$salesdetail->delete()) {
                    $this->db->rollback();
                    $msg = $this->getValidateMessage('sale', 'db', 'delete-failed');
                    return $this->error([$msg]);
                }
            }

            // 然后新增销售单详情
            // 封装的过程中如果操作失败会回滚，所以放弃了封装，直接放在这里显示
            foreach ($this->saleParams['list'] as $k => $item) {
                if (isset($item)) {
                    $_POST = $item;
                }

                // 添加销售单
                if (!isset($_POST["salesid"]) || $_POST["salesid"] == "") {
                    $_POST["salesid"] = $this->salesid;
                }

                // 判断接收的参数是否正常
                // 首先是键名是否存在
                if (
                    !array_key_exists('productid', $_POST) ||
                    !array_key_exists('sizecontentid', $_POST) ||
                    !array_key_exists('number', $_POST)
                ) {
                    $this->db->rollback();
                    $msg = $this->getValidateMessage('orderdetail', 'db', 'add-failed');
                    return $this->error([$msg]);
                }

                // 其次是键值是否正常
                if (
                    !$_POST['productid'] ||
                    !$_POST['sizecontentid'] ||
                    !$_POST['number']
                ) {
                    $this->db->rollback();
                    $msg = $this->getValidateMessage('orderdetail', 'db', 'add-failed');
                    return $this->error([$msg]);
                }

                // 使用模型更新
                // 这里用的是销售单详情表
                $salesdetail = new XsSalesdetails();
                $data = [
                    'productid' => $_POST['productid'],
                    'sizecontentid' => $_POST['sizecontentid'],
                    'number' => $_POST['number'],
                    'salesid' => $_POST['salesid'],
                    'saleno' => $this->saleno,
                ];

                if (!$salesdetail->save($data)) {
                    $this->db->rollback();
                    $msg = $this->getValidateMessage('salesdetail', 'db', 'add-failed');
                    return $this->error([$msg]);
                }
            }

            // 提交事务
            $this->db->commit();

        } else {
            // 没有销售单号就新增
            // 采用事务处理
            $this->db->begin();
            // 把执行结果放在缓冲区，然后取出来
            ob_start();
            $this->doAdd();
            $sale = ob_get_contents();
            ob_end_clean();

            // 转成数组
            $sale_arr = json_decode($sale, true);

            // 判断是否更新成功
            if (array_key_exists('messages', $sale_arr) && count($sale_arr['messages']) > 0) {
                $this->db->rollback();
                // 取出错误记录，因为在模型验证的时候，基本上都是出现错误就停止继续运行，所以只取出一条记录即可。
                return $this->error([$sale_arr['messages'][0]]);
            }

            // 取出销售单id
            $this->salesid = $sale_arr['id'];

            // 开始写入销售单详情表
            // 封装的过程中如果操作失败会回滚，所以放弃了封装，直接放在这里显示
            foreach ($this->saleParams['list'] as $k => $item) {
                if (isset($item)) {
                    $_POST = $item;
                }

                // 添加销售单
                if (!isset($_POST["salesid"]) || $_POST["salesid"] == "") {
                    $_POST["salesid"] = $this->salesid;
                }

                // 判断接收的参数是否正常
                // 首先是键名是否存在
                if (
                    !array_key_exists('productid', $_POST) ||
                    !array_key_exists('sizecontentid', $_POST) ||
                    !array_key_exists('number', $_POST)
                ) {
                    $this->db->rollback();
                    $msg = $this->getValidateMessage('orderdetail', 'db', 'add-failed');
                    return $this->error([$msg]);
                }

                // 其次是键值是否正常
                if (
                    !$_POST['productid'] ||
                    !$_POST['sizecontentid'] ||
                    !$_POST['number']
                ) {
                    $this->db->rollback();
                    $msg = $this->getValidateMessage('orderdetail', 'db', 'add-failed');
                    return $this->error([$msg]);
                }

                // 使用模型更新
                // 这里用的是销售单详情表
                $salesdetail = new XsSalesdetails();
                $data = [
                    'productid' => $_POST['productid'],
                    'sizecontentid' => $_POST['sizecontentid'],
                    'number' => $_POST['number'],
                    'salesid' => $_POST['salesid'],
                    'saleno' => $this->saleno,
                ];

                if (!$salesdetail->save($data)) {
                    $this->db->rollback();
                    $msg = $this->getValidateMessage('salesdetail', 'db', 'add-failed');
                    return $this->error([$msg]);
                }
            }

            // 提交事务
            $this->db->commit();
        }

        // 取出单个模型及下级销售单详情逻辑
        $this->getsale($this->salesid);
    }


    /**
     * 读取销售单信息，必须传一个id参数，代表销售单编号
     * @return false|string
     */
    public function loadsaleAction()
    {
        // 必须传递一个销售单id
        if (!$this->request->get('id')) {
            $msg = $this->getValidateMessage('sale', 'template', 'required');
            return $this->error([$msg]);
        }
        $this->salesid = $this->request->get('id');
        // 取出单个模型及下级销售单详情逻辑
        $this->getsale($this->salesid);
    }

    /**
     * 重写，添加销售单号以及其他必要的参数
     */
    public function doAdd()
    {
        if ($this->request->isPost()) {
            // 更新数据库
            // 开始解析参数，转化成直接post请求
            foreach ($this->saleParams['form'] as $k => $item) {
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
            // 生成销售单号
            $company_rand = TbCompany::findFirstById($this->companyid)->randid;
            // 开始处理随机数，保存成6位数字
            $company_rand = Util::cover_position($company_rand, 6);
            $this->saleno = 'S' . $company_rand . date('YmdHis') . mt_rand(1000, 9999);
            if (!isset($_POST["saleno"]) || $_POST["saleno"] == "") {
                $_POST["saleno"] = $this->saleno;
            }

            // 继续执行父类其他方法
            parent::doAdd();
        }
    }

    // /**
    //  * 销售单详情表分功能，内嵌共通，因为涉及到事务回滚，如果操作失败就报错，所以此封装作废
    //  */
    // private function addsalesdetail()
    // {
    //     foreach ($this->saleParams['list'] as $k => $item) {
    //         if (isset($item)) {
    //             $_POST = $item;
    //         }
    //
    //         // 添加销售单
    //         if (!isset($_POST["salesid"]) || $_POST["salesid"] == "") {
    //             $_POST["salesid"] = $this->salesid;
    //         }
    //
    //         // 判断接收的参数是否正常
    //         // 首先是键名是否存在
    //         if (
    //             !array_key_exists('productid', $_POST) ||
    //             !array_key_exists('sizecontentid', $_POST) ||
    //             !array_key_exists('number', $_POST)
    //         ) {
    //             $this->db->rollback();
    //             $msg = $this->getValidateMessage('orderdetail', 'db', 'add-failed');
    //             return $this->error([$msg]);
    //         }
    //
    //         // 其次是键值是否正常
    //         if (
    //             !$_POST['productid'] ||
    //             !$_POST['sizecontentid'] ||
    //             !$_POST['number']
    //         ) {
    //             $this->db->rollback();
    //             $msg = $this->getValidateMessage('orderdetail', 'db', 'add-failed');
    //             return $this->error([$msg]);
    //         }
    //
    //         // 使用模型更新
    //         // 这里用的是销售单详情表
    //         $salesdetail = new XsSalesdetails();
    //         $data = [
    //             'productid' => $_POST['productid'],
    //             'sizecontentid' => $_POST['sizecontentid'],
    //             'number' => $_POST['number'],
    //             'salesid' => $_POST['salesid'],
    //             'saleno' => $this->saleno,
    //         ];
    //
    //         if (!$salesdetail->save($data)) {
    //             $this->db->rollback();
    //             $msg = $this->getValidateMessage('salesdetail', 'db', 'add-failed');
    //             return $this->error([$msg]);
    //         }
    //     }
    // }


    /**
     * 根据销售单id查询出每个销售单下面的模型和具体销售单详情
     * @param $salesid
     * @return false|string
     */
    public function getsale($salesid)
    {
        // 根据salesid查询出当前销售单以及销售单详情的所有信息
        $sale = XsSales::findFirstById($salesid);
        // 判断销售单是否存在
        if (!$sale) {
            $msg = $this->getValidateMessage('salesdetail', 'template', 'notexist');
            echo $this->error([$msg]);
            exit;
        }
        // 清除原来的list节点和form节点
        unset($this->saleParams['form']);
        unset($this->saleParams['list']);
        // 添加form节点
        $this->saleParams['form'] = $sale->toArray();
        // 循环添加数据
        foreach ($sale->salesdetails as $k => $salesdetail) {
            // 过滤已经删除的数据
            if ($salesdetail->sys_delete_flag == '0') {
                $product = $salesdetail->product->toArray();
                $salesdetail = $salesdetail->toArray();
                $salesdetail["product"] = $product;
                $this->saleParams['list'][] = $salesdetail;
            }
        }
        // 最终成功返回，原来的数据还要保留，再加上销售单详情之中每个商品的名称也要放进去
        echo $this->success($this->saleParams);
        $this->view->disable();
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
        $sale = XsSales::findFirstById($this->salesid);
        // 判断销售单是否存在
        if (!$sale) {
            $msg = $this->getValidateMessage('sale', 'template', 'notexist');
            return $this->error([$msg]);
        }
        // 继续执行其他方法
        parent::deleteAction();
    }
}
