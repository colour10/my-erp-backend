<?php
namespace Multiple\Home\Controllers;

use Phalcon\Mvc\Controller;
use Phalcon\Mvc\View;
use Asa\Erp\TbRequisitionDetail;

/**
 * 调拨单相关，调拨单明细表
 */
class RequisitiondetailController extends AdminController {
    public function initialize() {
	    parent::initialize();

	    $this->setModelName('Asa\\Erp\\TbRequisitionDetail');
    }
}
