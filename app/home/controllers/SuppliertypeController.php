<?php
namespace Multiple\Home\Controllers;

use Phalcon\Mvc\Controller;
use Phalcon\Mvc\View;
use Asa\Erp\ZlSupplierType;

/**
 * 供货商相关信息，关系单位类型表
 */
class SuppliertypeController extends AdminController {
    public function initialize() {
	    parent::initialize();

	    $this->setModelName('Asa\\Erp\\ZlSupplierType');
    }
}
