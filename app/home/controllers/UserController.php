<?php
namespace Multiple\Home\Controllers;

use Phalcon\Mvc\Controller;
use Phalcon\Mvc\View;
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
    
    function modifypasswordAction() {
        // Disable several levels
        $this->view->disableLevel(
            array(
                View::LEVEL_LAYOUT => true
            )
        );
        
        if($this->request->isPost()) {
            $result = array("code"=>200, "messages" => array());
            echo json_encode($result);
            $this->view->disable();
        }
    }
}
