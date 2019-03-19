<?php
namespace Multiple\Home\Controllers;

use Phalcon\Mvc\Controller;
use Phalcon\Mvc\View;
use Asa\Erp\DdConfirmorder;

/**
 * 发货单主表
 */
class ConfirmorderController extends CadminController {
    public function initialize() {
	    parent::initialize();

	    $this->setModelName('Asa\\Erp\\DdConfirmorder');
    }
}
