<?php
namespace Multiple\Home\Controllers;

use Phalcon\Mvc\Controller;
use Phalcon\Mvc\View;
use Asa\Erp\XsSalesdetails;

/**
 * 销售单 明细表
 */
class SalesdetailsController extends CadminController {
    public function initialize() {
	    parent::initialize();

	    $this->setModelName('Asa\\Erp\\XsSalesdetails');
    }
}
