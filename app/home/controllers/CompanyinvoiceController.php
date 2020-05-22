<?php

namespace Multiple\Home\Controllers;

/**
 * 基公司发票管理表
 * Class CompanyinvoiceController
 * @package Multiple\Home\Controllers
 */
class CompanyinvoiceController extends CadminController
{
    public function initialize()
    {
        parent::initialize();

        $this->setModelName('Asa\\Erp\\TbCompanyInvoice');
    }
}
