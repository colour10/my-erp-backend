<?php
namespace Multiple\Home\Controllers;

use Phalcon\Mvc\Controller;
use Phalcon\Mvc\View;
use Asa\Erp\ZlProductinnards;

/**
 * 内部结构
 */
class ProductinnardsController extends ZadminController {    
    public function initialize() {
	    parent::initialize();
	    
	    $this->setModelName('Asa\\Erp\\ZlProductinnards');
    }
}
        