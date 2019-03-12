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
    
    public function beforeExecuteRoute($dispatcher)
    {
        // 这个方法会在每一个能找到的action前执行
        $action = $dispatcher->getActionName();
        if ($action === "edit" || $action=='add') {
            
            if(isset($_POST["password"]) && !preg_match("#^[0-9a-z]{32}$#", $_POST["password"])) {
                //echo $_POST["password"];exit;
                $_POST["password"] = md5($_POST["password"]);
            }
        }
    }
}
