<?php
namespace Multiple\Home\Controllers;

use Phalcon\Mvc\Controller;
use Phalcon\Mvc\View;
use Demo\SysStudent;

class AliasController extends AdminController {    
    public function initialize() {
	    parent::initialize();
	    
	    $this->setModelName('Demo\\SysStudent');
    }
}
