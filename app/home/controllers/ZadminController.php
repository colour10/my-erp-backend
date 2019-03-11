<?php
namespace Multiple\Home\Controllers;

use Phalcon\Mvc\Controller;
use Phalcon\Mvc\View;

/**
 * 支持多国语言版本的表的基类
 */
class ZadminController extends AdminController {
    protected $default_language = "zh-cn";
    
    public function initialize() {
	    parent::initialize();
    }
    
    function indexAction() {
        $findFirst = new \ReflectionMethod($this->getModelName(), 'find');
	    $result = $findFirst->invokeArgs(null, array(
	        sprintf("sys_delete_flag=0 and lang_code='%s'", addslashes($this->default_language))
	    ));

	    $this->view->setVar("result", $result->toArray());
	    $this->view->setVar("default_language", $this->default_language);
    }
    
    function getSearchCondition() {
        if($this->request->isPost()) {
            if(!isset($_POST["land_code"])) {
                $_REQUEST["lang_code"] = $this->default_language;
                $_POST["lang_code"] = $this->default_language;
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
                
                if($row->relateid>0) {
                    $this->updateLanguages($row->relateid);       
                }
                else {
                    $row->relateid = $row->id;
                    $row->languages = $row->lang_code;
                    $row->save();
                }
            }
            echo json_encode($result);
            $this->view->disable();
	    }
	}
	
	function loadAction() {
	    $findFirst = new \ReflectionMethod($this->getModelName(), 'findFirst');
	    $row = $findFirst->invokeArgs(null, array(
	        sprintf("relateid=%d and lang_code='%s' and sys_delete_flag=0", $_POST['relateid'], addslashes($_POST['lang_code']))
	    ));

	    if($row!=false) {   
	        echo json_encode($row->toArray());   
	    }
	    else {
	        echo '{}';   
	    }
	    $this->view->disable();
	}
	
	/*
	 * 同时删除多国语言的各个版本
	 */	
	function deleteGroupAction() {
	    $findFirst = new \ReflectionMethod($this->getModelName(), 'findFirst');
	    $row = $findFirst->invokeArgs(null, array($this->getCondition()));

	    $result = array("code"=>200, "messages" => array());
	    if($row!=false) {
	        $find = new \ReflectionMethod($this->getModelName(), 'find');
    	    $records = $find->invokeArgs(null, array(
    	        sprintf("sys_delete_flag=0 and relateid=%d", $row->relateid)
    	    ));

	        foreach($records as $record) {
    	        if ($record->delete() == false) {
    	            $messages = $record->getMessages();
    
                    foreach ($messages as $message) {
                        $result["messages"][] = $message->getMessage();
                    }
    	        }
    	    }
	    }
	    echo json_encode($result);
        $this->view->disable();
	}
	
	private function updateLanguages($relateid) {
	    $find = new \ReflectionMethod($this->getModelName(), 'find');
	    $result = $find->invokeArgs(null, array(
	        sprintf("sys_delete_flag=0 and relateid=%d", $relateid)
	    ));
	    
	    $array = [];
	    foreach($result as $row) {
	        $array[] = $row->lang_code;   
	    }
	    
	    $findFirst = new \ReflectionMethod($this->getModelName(), 'findFirst');
        $row = $findFirst->invokeArgs(null, array(
            sprintf("sys_delete_flag=0 and lang_code='%s' and relateid=%d", addslashes($this->default_language), $relateid)
        ));

        if($row!=false) {
            $row->languages = implode(",", $array);
            $row->save();   
        }
	}
}
