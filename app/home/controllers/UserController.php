<?php
namespace Multiple\Home\Controllers;

use Phalcon\Mvc\Controller;
use Phalcon\Mvc\View;
use Asa\Erp\TbUser;

class UserController extends CadminController {    
    public function initialize() {
	    parent::initialize();
	    
	    $this->setModelName('Asa\\Erp\\TbUser');
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
    
    function deletegroupAction() {
        $this->doEdit();
    }
}
