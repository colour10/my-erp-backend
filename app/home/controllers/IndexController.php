<?php
namespace Multiple\Home\Controllers;
use Phalcon\Mvc\Controller;
use Demo\SysStudent;

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
}
