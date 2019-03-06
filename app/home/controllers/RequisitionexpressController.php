<?php
namespace Multiple\Home\Controllers;

use Phalcon\Mvc\Controller;
use Phalcon\Mvc\View;
use Asa\Erp\TbRequisitionExpress;

/**
 * 调拨单相关，快递信息表
 */
class RequisitionexpressController extends AdminController {
    public function initialize() {
	    parent::initialize();

	    $this->setModelName('Asa\\Erp\\TbRequisitionExpress');
    }
}
