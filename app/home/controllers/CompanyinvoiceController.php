<?php

namespace Multiple\Home\Controllers;

use Phalcon\Mvc\Controller;
use Phalcon\Mvc\View;
use Asa\Erp\TbCompanyInvoice;

/**
 * 分组表
 */
class CompanyinvoiceController extends CadminController {
    public function initialize() {
        parent::initialize();

        $this->setModelName('Asa\\Erp\\TbCompanyInvoice');
    }
}
