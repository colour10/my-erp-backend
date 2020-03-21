<?php

namespace Multiple\Home\Controllers;

use Asa\Erp\TbBill;

/**
 * 对账单回款表控制器
 * Class BillconfirmController
 * @package Multiple\Home\Controllers
 */
class BillconfirmController extends AdminController
{
    public function initialize()
    {
        parent::initialize();

        $this->setModelName('Asa\\Erp\\TbBillConfirm');
    }

    function before_add()
    {
        $_POST['createstaff'] = $this->currentUser;
        $_POST['companyid'] = $this->companyid;
        $_POST['createtime'] = date("Y-m-d H:i:s");

        $bill = $this->checkBill($_POST['billid']);
        $_POST['currencyid'] = $bill->currencyid;
    }

    function before_edit($row)
    {
        $this->checkBill($row->billid);
    }

    function before_delete($row)
    {
        $this->checkBill($row->billid);
    }

    function before_page()
    {
        $this->checkBill($_POST['billid']);
    }

    private function checkBill($billid)
    {
        $bill = TbBill::findFirstById($billid);
        if ($bill == false || $bill->companyid != $this->companyid) {
            throw new \Exception('/11190101/非法请求/');
        }

        return $bill;
    }
}
