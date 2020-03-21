<?php

namespace Multiple\Home\Controllers;

/**
 * 分组表
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
