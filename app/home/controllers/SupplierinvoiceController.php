<?php

namespace Multiple\Home\Controllers;

use Phalcon\Mvc\Controller;
use Phalcon\Mvc\View;
use Asa\Erp\TbSupplierInvoice;

/**
 * 分组表
 */
class SupplierinvoiceController extends CadminController {
    public function initialize() {
        parent::initialize();

        $this->setModelName('Asa\\Erp\\TbSupplierInvoice');
    }

    function before_add() {
        $_POST['companyid'] = $this->companyid;
    }

    function before_edit($row) {
        if(isset($_POST['companyid']) || isset($_POST['supplierid']) || $row->companyid!=$this->companyid) {
            throw new \Exception("/1001/数据非法/");
        }
    }

    function before_delete($row) {
        if($row->companyid!=$this->companyid) {
            throw new \Exception('/1002/数据非法/');
        }
    }

    function before_page() {
        $_POST['companyid'] = $this->companyid;
    }
}
