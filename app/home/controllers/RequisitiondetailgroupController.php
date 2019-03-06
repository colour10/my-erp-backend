<?php
namespace Multiple\Home\Controllers;

use Phalcon\Mvc\Controller;
use Phalcon\Mvc\View;
use Asa\Erp\TbRequisitionDetailGroup;

/**
 * 调拨单相关，调拨单明细（数量）表
 */
class RequisitiondetailgroupController extends AdminController {
    public function initialize() {
	    parent::initialize();

	    $this->setModelName('Asa\\Erp\\TbRequisitionDetailGroup');
    }
}
