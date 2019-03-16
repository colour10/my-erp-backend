<?php
namespace Multiple\Home\Controllers;

use Phalcon\Mvc\Controller;
use Phalcon\Mvc\View;
use Asa\Erp\DdOrderdetails;

/**
 * 订单明细表
 */
class OrderdetailsController extends CadminController {
    public function initialize() {
	    parent::initialize();

	    $this->setModelName('Asa\\Erp\\DdOrderdetails');
    }
}
