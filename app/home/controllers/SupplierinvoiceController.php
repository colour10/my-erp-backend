<?php

namespace Multiple\Home\Controllers;

use Asa\Erp\TbSupplierInvoice;

/**
 * 分组表
 * Class SupplierinvoiceController
 * @package Multiple\Home\Controllers
 */
class SupplierinvoiceController extends CadminController
{
    public function initialize()
    {
        parent::initialize();

        $this->setModelName('Asa\\Erp\\TbSupplierInvoice');
    }

    function before_add()
    {
        $_POST['companyid'] = $this->companyid;
    }

    function before_edit($row)
    {
        if (isset($_POST['companyid']) || isset($_POST['supplierid']) || $row->companyid != $this->companyid) {
            throw new \Exception("/1001/数据非法/");
        }
    }

    function before_delete($row)
    {
        if ($row->companyid != $this->companyid) {
            throw new \Exception('/1002/数据非法/');
        }
    }

    function before_page()
    {
        $_POST['companyid'] = $this->companyid;
    }

    /**
     * 根据supperid，返回客户的发票列表
     * @return false|string [type] [description]
     */
    function getlistAction()
    {
        if (isset($_POST['supplierid'])) {
            $result = TbSupplierInvoice::find(
                sprintf("companyid=%d and supplierid=%d", $this->companyid, $_POST['supplierid'])
            );

            return $this->success($result->toArray());
        } else {
            return $this->success();
        }
    }
}
