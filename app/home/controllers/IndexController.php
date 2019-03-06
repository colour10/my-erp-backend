<?php
namespace Multiple\Home\Controllers;
use Phalcon\Mvc\Controller;
use Asa\Erp\TbDepartment;

class IndexController extends BaseController
{

	public function indexAction()
	{
	    
	}
    
    function saveAction() {
        if($this->request->isPost()) {
            $result = array("code" => 200, "messages" => array());
            $model_filename = APP_PATH . '/app/models/erp/'.$_POST["modelName"].".php";
            if(!file_exists($model_filename)) {
                file_put_contents($model_filename, $_POST['model']);
            }
            else {
                $result["messages"][] = "model文件存在。";
            }
            
            $controller_filename = APP_PATH . '/app/home/controllers/'.$_POST["controllerName"].".php";
            if(!file_exists($controller_filename)) {
                file_put_contents($controller_filename, $_POST['controller']);
            }
            else {
                $result["messages"][] = "controller文件存在。";
            }
            
            echo json_encode($result);
            $this->view->disable();
        }           
    }
    
    function createAction() {
        $d = new TbDepartment();
        $d->Name = "hellow".time();
        if($d->save()==false) {
            $messages = $d->getMessages();

            foreach ($messages as $message) {
                echo 'Message: ', $message->getMessage()."\n";
                echo 'Field: ', $message->getField()."\n";
                echo 'Type: ', $message->getType()."\n";
               
            }
        }
        exit;        
    }
    
    function save2Action() {
        $depart = TbDepartment::findFirst("id=4");   
        if($depart!=false) {
            $depart->Name = "新名字2";
            if($depart->save()==false) {
                $messages = $depart->getMessages();
    
                foreach ($messages as $message) {
                    echo 'Message: ', $message->getMessage();
                    echo 'Field: ', $message->getField();
                    echo 'Type: ', $message->getType();
                   
                }
            }
        }
        else {
            echo "record not exist.";   
        }
        
        exit;
    }
    
    function deleteAction() {
        $depart = TbDepartment::findFirst("id=4");   
        if($depart!=false) {
            if($depart->delete()==false) {
                $messages = $depart->getMessages();
    
                foreach ($messages as $message) {
                    echo 'Message: ', $message->getMessage();
                    echo 'Field: ', $message->getField();
                    echo 'Type: ', $message->getType();
                   
                }
            }
        }
        else {
            echo "record not exist.";   
        }
        
        exit;
    }
}
