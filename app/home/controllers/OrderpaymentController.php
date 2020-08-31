<?php

namespace Multiple\Home\Controllers;

use Asa\Erp\TbOrderPayment;
use Exception;

/**
 * 付款单控制器
 *
 * Class OrderpaymentController
 * @package Multiple\Home\Controllers
 */
class OrderpaymentController extends CadminController
{
    /**
     * 初始化
     */
    public function initialize()
    {
        parent::initialize();

        $this->setModelName('Asa\\Erp\\TbOrderPayment');
    }

    /**
     * 添加前
     *
     * @throws Exception
     */
    function before_add()
    {
        $_POST['makestaff'] = $this->currentUser;
        $_POST['companyid'] = $this->companyid;
        $_POST['maketime'] = date("Y-m-d H:i:s");
        // 未付款
        $_POST['status'] = TbOrderPayment::STATUS_UNPAID;

        if (isset($_POST['confirmstaff']) || isset($_POST['confirmtime'])) {
            throw new Exception("/1001/数据非法/");
        }
    }

    /**
     * 编辑前
     *
     * @param $row
     * @throws Exception
     */
    function before_edit($row)
    {
        // 未付款
        $_POST['status'] = TbOrderPayment::STATUS_UNPAID;

        if (isset($_POST['confirmstaff']) || isset($_POST['confirmtime'])) {
            throw new Exception("/1001/数据非法/");
        }

        if ($row->status != TbOrderPayment::STATUS_UNPAID || $row->makestaff != $this->currentUser) {
            throw new Exception('/1002/不允许修改/');
        }
    }

    /**
     * 删除前
     *
     * @param $row
     * @throws Exception
     */
    function before_delete($row)
    {
        if ($row->status != TbOrderPayment::STATUS_UNPAID || $row->makestaff != $this->currentUser) {
            throw new Exception('/1002/不允许删除/');
        }
    }

    /**
     * 分页前
     */
    function before_page()
    {
        $_POST['companyid'] = $this->companyid;
    }

    /**
     * 搜索
     *
     * @throws \ReflectionException
     */
    function searchAction()
    {
        return $this->pageAction();
    }

    /**
     * 确认该笔款已经支付
     * @return false|string [type] [description]
     * @throws Exception
     */
    function confirmAction()
    {
        $row = TbOrderPayment::findFirstById($this->request->getPost("id"));
        if ($row != false && $row->companyid == $this->companyid) {
            if ($row->status == TbOrderPayment::STATUS_PAID) {
                throw new Exception('/1002/付款已经确认过了。/');
            }
            $row->confirmtime = date("Y-m-d H:i:s");
            $row->confirmstaff = $this->currentUser;
            $row->paymentdate = $this->request->getPost("paymentdate");
            $row->memo = $this->request->getPost("memo");
            // 已付款
            $row->status = TbOrderPayment::STATUS_PAID;

            if ($row->save() == false) {
                return $this->error($row);
            } else {
                return $this->success($row->toArray());
            }
        } else {
            throw new Exception('/1001/记录不存在。/');
        }
    }
}
