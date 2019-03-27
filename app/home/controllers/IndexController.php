<?php
namespace Multiple\Home\Controllers;
use Phalcon\Mvc\Controller;
use Asa\Erp\TbDepartment;
use Asa\Erp\TbUser;
use Asa\Erp\TbCompany;

class IndexController extends BaseController
{

	public function indexAction()
	{
        $this->view->enable();
        $this->view->setVar("system_language", $this->language);
        $this->view->setVar("__sytem_time", time());
        
        $default_language = $this->config->language;
        $this->view->setVar("__default_language", $this->config->language);
        $this->view->setVar("__config", $this->config);
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
    
    function initAction() {
        $this->session->user = array(
            "id" => 1,
            "username" => "admin",
            "companyid" => 1
        );
        $db = $this->db;
        $db->execute("truncate table tb_company");
        $db->execute("truncate table tb_user");
        $db->execute("truncate table tb_department");
        $datetime = date('Y-m-d H:i:s');
        $company = new TbCompany();
        $company->setValidateLanguage("cn");
        $company->name_cn = "company". time();
        if($company->save()==false) {
            $messages = $company->getMessages();

            foreach ($messages as $message) {
                echo 'Message: ', $message->getMessage();
                echo 'Field: ', $message->getField();
                echo 'Type: ', $message->getType();
               
            }
            exit;
        }
        
        $user = new TbUser();
        $user->login_name = "admin";
        $user->password = md5("123456");
        $user->companyid = $company->id;
        $user->save();
        
        $depart = new TbDepartment();
        $depart->name = $company->name_cn;
        $depart->remark = $company->name_cn;
        $depart->companyid = $company->id;
        $depart->save();
        
        echo "Init Success.";exit;
    }
}
