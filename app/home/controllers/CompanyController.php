<?php
namespace Multiple\Home\Controllers;

use Phalcon\Mvc\Controller;
use Phalcon\Mvc\View;
use Asa\Erp\TbCompany;

/**
 * 公司表
 */
class CompanyController extends AdminController {
    public function initialize() {
	    parent::initialize();

	    $this->setModelName('Asa\\Erp\\TbCompany');
    }
}
