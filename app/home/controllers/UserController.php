<?php
namespace Multiple\Home\Controllers;

use Phalcon\Mvc\Controller;
use Demo\SysStudent;

class UserController extends AdminController {    
    public function initialize() {
	    parent::initialize();
	    
	    $this->setModelName('Demo\\SysStudent');
    }
    
    function formAction() {
        try {
            $s = SysStudent::findFirst("id=3");
            echo $s->name;exit;
        }
        catch(Exception $e) {
            echo $e->getMessage();
        }
    }
    
    function modifypassowrdAction() {
        
    }
}
