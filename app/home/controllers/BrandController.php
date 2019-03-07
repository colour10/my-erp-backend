<?php
namespace Multiple\Home\Controllers;

use Phalcon\Mvc\Controller;
use Phalcon\Mvc\View;
use Asa\Erp\ZlBrand;

class BrandController extends AdminController {    
    public function initialize() {
	    parent::initialize();
	    
	    $this->setModelName('Asa\Erp\ZlBrand');
    }
}
