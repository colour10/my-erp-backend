<?php
namespace Multiple\Home\Controllers;

use Phalcon\Mvc\Controller;
use Phalcon\Mvc\View;
use Asa\Erp\ZlProductparts;

/**
 * 附带配件
 */
class ProductpartsController extends AdminController {    
    public function initialize() {
	    parent::initialize();
	    
	    $this->setModelName('Asa\\Erp\\ZlProductparts');
    }
}
        