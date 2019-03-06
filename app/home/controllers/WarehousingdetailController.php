<?php
namespace Multiple\Home\Controllers;

use Phalcon\Mvc\Controller;
use Phalcon\Mvc\View;
use Asa\Erp\TbWarehousingDetail;

/**
 * 入库单明细表
 */
class WarehousingdetailController extends AdminController {
    public function initialize() {
	    parent::initialize();

	    $this->setModelName('Asa\\Erp\\TbWarehousingDetail');
    }
}
