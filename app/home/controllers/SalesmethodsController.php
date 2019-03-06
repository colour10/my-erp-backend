<?php
namespace Multiple\Home\Controllers;

use Phalcon\Mvc\Controller;
use Phalcon\Mvc\View;
use Asa\Erp\ZlSalesmethods;

/**
 * 基础资料，销售性质表
 */
class SalesmethodsController extends AdminController {
    public function initialize() {
	    parent::initialize();

	    $this->setModelName('Asa\\Erp\\ZlSalesmethods');
    }
}
