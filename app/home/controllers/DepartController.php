<?php
namespace Multiple\Home\Controllers;

use Phalcon\Mvc\Controller;
use Demo\SysStudent;

class DepartController extends AdminController
{

	public function initialize() {
	    parent::initialize();
        $this->setModelName('Demo\\SysStudent');
    }    
    
    function indexAction() {
    }
}
