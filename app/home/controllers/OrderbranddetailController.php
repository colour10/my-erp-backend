<?php
namespace Multiple\Home\Controllers;

use Phalcon\Mvc\Controller;
use Phalcon\Mvc\View;
use Asa\Erp\TbOrderBrandDetail;

/**
 * 品牌订单明细
 */
class OrderbranddetailController extends AdminController {
    public function initialize() {
	    parent::initialize();

	    $this->setModelName('Asa\\Erp\\TbOrderBrandDetail');
    }
}
