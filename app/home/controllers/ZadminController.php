<?php
namespace Multiple\Home\Controllers;

use Phalcon\Mvc\Controller;
use Phalcon\Mvc\View;

/**
 * 支持多国语言版本的表的基类
 */
class ZadminController extends AdminController {
    protected $default_language = "cn";
    
    public function initialize() {
	    parent::initialize();
    }
    
    function indexAction() {
    }

    function getModelObject() {
        $model = parent::getModelObject();
        $model->setValidateLanguage(isset($_REQUEST['lang']) ? $_REQUEST['lang'] : $this->default_language);

        return $model;
    }
    
    function getSearchCondition() {
        if($this->request->isPost()) {
            if(!isset($_POST["land_code"])) {
                //$_REQUEST["lang_code"] = $this->default_language;
                //$_POST["lang_code"] = $this->default_language;
                //print_r($_POST);
            }
	    }  
	    return parent::getSearchCondition();
    }
    
    function doAdd() {
	    if($this->request->isPost()) {
	        //更新数据库
	        $row = $this->getModelObject();

	        $fields = $this->getAttributes();
	        foreach($fields as $name) {
	            if(isset($_POST[$name])) {
	                $row->$name = $_POST[$name];
	            }
	        }

            $result = array("code"=>200, "messages" => array());
	        if ($row->create() === false) {
                $messages = $row->getMessages();

                foreach ($messages as $message) {
                    $result["messages"][] = $message->getMessage();
                }
            }
            else {
                $result['is_add'] = "1";
                $result['id'] = $row->id;
            }
            echo json_encode($result);            
	    }
	}
	
	function loadAction() {
	    $findFirst = new \ReflectionMethod($this->getModelName(), 'findFirst');
	    $row = $findFirst->invokeArgs(null, array(
	        sprintf("id=%d", $_POST['id'])
	    ));

	    if($row!=false) {   
            echo $this->reportJson(["data" => $row->toArray()]); 
	    }
	    else {
	        echo '{}';   
	    }
	}	

    function doEdit()
    {
        if ($this->request->isPost()) {
            //锟斤拷锟斤拷锟斤拷锟捷匡拷
            $findFirst = new \ReflectionMethod($this->getModelName(), 'findFirst');
            $row = $findFirst->invokeArgs(null, array($this->getCondition()));

            if ($row != false) {
                $row->setValidateLanguage(isset($_REQUEST['lang']) ? $_REQUEST['lang'] : $this->default_language);

                $fields = $this->getAttributes();

                foreach ($fields as $name) {
                    if (isset($_POST[$name]) && !preg_match("#^sys_#", $name)) {
                        $row->$name = $_POST[$name];
                    }
                }
                

                $result = array("code" => 200, "messages" => array());
                if ($row->save() === false) {
                    $messages = $row->getMessages();

                    foreach ($messages as $message) {
                        $result["messages"][] = $message->getMessage();
                    }
                }
                
                echo json_encode($result);
                
            }
            else {
                $result = array("code"=>200, "messages" => array("数据不存在"));

                echo json_encode($result);
                exit;
            }
        }
    }
}
