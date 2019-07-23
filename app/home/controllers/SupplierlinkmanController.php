<?php
namespace Multiple\Home\Controllers;

use Phalcon\Mvc\Controller;
use Phalcon\Mvc\View;
use Asa\Erp\TbSupplierLinkman;

/**
 * 供应商，联系人信息
 */
class SupplierlinkmanController extends AdminController {
    public function initialize() {
	    parent::initialize();

	    $this->setModelName('Asa\\Erp\\TbSupplierLinkman');
    }
}
