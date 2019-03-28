<?php
namespace Multiple\Home\Controllers;

use Phalcon\Mvc\Controller;
use Phalcon\Mvc\View;
use Asa\Erp\DdConfirmorderdetails;

/**
 * 发货单明细表
 */
class ConfirmorderdetailsController extends CadminController {
    public function initialize() {
	    parent::initialize();

	    $this->setModelName('Asa\\Erp\\DdConfirmorderdetails');
    }
}
