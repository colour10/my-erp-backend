<?php
namespace Multiple\Home\Controllers;
use Phalcon\Mvc\Controller;
use Asa\Erp\TbDepartment;
use Asa\Erp\TbUser;
use Asa\Erp\TbCompany;
use Asa\Erp\TbRequisitionDetail;
use Phalcon\Mvc\View;

class IndexController extends BaseController
{

	public function indexAction()
	{
        $this->view->enable();
        $this->view->setVar("__sytem_time", time());        
	}   

    function createAction() {
        if($this->request->isPost()) {
            $this->view->disableLevel(View::LEVEL_MAIN_LAYOUT);
            $this->view->setVar("model", $_POST["model"]);
            $this->view->setVar("table", $_POST["table_name"]);
            $this->view->setVar("remark", $_POST["remark"]);
            $this->view->setVar("controller", $_POST["controller"]);
            $this->view->setVar("parent", $_POST["parent"]);
            


            $result = array("code" => 200, "messages" => array());
            $model_filename = APP_PATH . '/app/models/erp/'.$_POST["model"].".php";
            if(!file_exists($model_filename)) {
                file_put_contents($model_filename, $this->view->getRender("index", "model"));
            }
            else {
                $result["messages"][] = "model文件存在。";
            }
            
            $controller_filename = APP_PATH . '/app/home/controllers/'.$_POST["controller"]."Controller.php";
            if(!file_exists($controller_filename)) {
                file_put_contents($controller_filename, $this->view->getRender("index", "controller"));
            }
            else {
                $result["messages"][] = "controller文件存在。";
            }
            
            echo json_encode($result);
        }           
    } 
}
