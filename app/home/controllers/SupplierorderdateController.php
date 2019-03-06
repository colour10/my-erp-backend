<?php
namespace Multiple\Home\Controllers;

use Phalcon\Mvc\Controller;
use Phalcon\Mvc\View;
use Asa\Erp\TbSupplierOrderdate;

/**
 * 供货商相关信息，订货日期表
 */
class SupplierorderdateController extends AdminController {
    public function initialize() {
	    parent::initialize();

	    $this->setModelName('Asa\\Erp\\TbSupplierOrderdate');
    }
}
