<?php
namespace Multiple\Home\Controllers;

use Phalcon\Mvc\Controller;
use Phalcon\Mvc\View;
use Asa\Erp\ZlBusinesstype;

/**
 * 基础资料，业务类型表
 */
class BusinesstypeController extends AdminController {
    public function initialize() {
	    parent::initialize();

	    $this->setModelName('Asa\\Erp\\ZlBusinesstype');
    }
}
