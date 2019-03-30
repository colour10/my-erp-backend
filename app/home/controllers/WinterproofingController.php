<?php
namespace Multiple\Home\Controllers;

use Phalcon\Mvc\Controller;
use Phalcon\Mvc\View;
use Asa\Erp\ZlWinterproofing;

/**
 * 防寒指数表
 */
class WinterproofingController extends ZadminController {
    public function initialize() {
	    parent::initialize();

	    $this->setModelName('Asa\\Erp\\ZlWinterproofing');
    }
}
