<?php
namespace Multiple\Home\Controllers;

use Phalcon\Mvc\Controller;
use Phalcon\Db\Column;
use  Phalcon\Mvc\Model\Message;

class AdminController extends BaseController
{
    protected $modelName;
    protected $modelObject;
    
    public function initialize() {
	    parent::initialize();
    }

    function setModelName($modelName) {
        $this->modelName = $modelName;
    }

    function getModelName() {
        return $this->modelName;
    }

    function getModelObject() {
        if(!$this->modelObject) {
            $class = new \ReflectionClass($this->getModelName());
            $this->modelObject = $class->newInstance();
        }

        return $this->modelObject;
    }

    function getAttributes() {
        $model = $this->getModelObject();

        try {
            $metaData = $model->getModelsMetaData();
            return $metaData->getAttributes($model);
        }
        catch(Exception $e) {
            echo $e->getMessage();
        }
    }

    function getCondition() {
        $model = $this->getModelObject();
        $metaData = $model->getModelsMetaData();
        $primaryKeys = $metaData->getPrimaryKeyAttributes($model);
        $fieldTypes = $metaData->getDataTypes($model);

        $array = array();

        foreach($primaryKeys as $key) {
            if($fieldTypes[$key]==Column::TYPE_INTEGER || $fieldTypes[$key]==Column::TYPE_BIGINTEGER || $fieldTypes[$key]==Column::TYPE_MEDIUMINTEGER || $fieldTypes[$key]==Column::TYPE_SMALLINTEGER || $fieldTypes[$key]==Column::TYPE_TINYINTEGER) {
                $array[] = sprintf("%s=%d", $key,$this->request->get($key));
            }
            else if($fieldTypes[$key]==Column::TYPE_CHAR || $fieldTypes[$key]==Column::TYPE_VARCHAR || $fieldTypes[$key]==Column::TYPE_ENUM ) {
                $array[] = sprintf("%s='%s'", $key,addslashes($this->request->get($key)));
            }
        }

        return implode(' and ', $array);
    }

	public function indexAction() {
        $findFirst = new \ReflectionMethod($this->getModelName(), 'find');
	    $result = $findFirst->invokeArgs(null, array("sys_delete_flag=0"));
	    
	    $this->view->setVar("result", $result->toArray());
	}
	
	public function listAction() {
	    $this->doList([]); 
	}
	
	public function doList($columns=array()) {
	    if($this->request->isAjax()) {	        
	        $findFirst = new \ReflectionMethod($this->getModelName(), 'find');
	        $result = $findFirst->invokeArgs(null, array());
	        
	        if(is_array($columns) && count($columns)>0) {
	            $list = array();
	            foreach($result as $row) {
	                $line = array();
	                
	                foreach($columns as $name) {
	                    $line[$name] = $row->$name;  
	                }
	                $list[] = $line;   
	            }
	            
	            echo json_encode($list);
	        }
	        else {
	            echo json_encode($result->toArray());
	        }
	    }
	    $this->view->disable();  
	}

	function editAction() {
	    //print_r($this->dispatcher->getParams());exit;
	    $this->doEdit();
	}

	function deleteAction() {
	    $this->doDelete();
	}

	function addAction() {
	    $this->doAdd();
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
                //$message['idd'] = "999";
            }
            echo json_encode($result);
            $this->view->disable();
	    }

	}

	function doEdit() {
	    if($this->request->isPost()) {
	        //更新数据库
	        $findFirst = new \ReflectionMethod($this->getModelName(), 'findFirst');
	        $row = $findFirst->invokeArgs(null, array($this->getCondition()));

	        if($row!=false) {
    	        $fields = $this->getAttributes();
    	        foreach($fields as $name) {
    	            if(isset($_POST[$name])) {
    	                $row->$name = $_POST[$name];
    	            }
    	        }

                $result = array("code"=>200, "messages" => array());
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
    	    $this->view->disable();
	    }
	    else {
	        //从数据库中查找数据，给到模板
	        $findFirst = new \ReflectionMethod($this->getModelName(), 'findFirst');
	        $info = $findFirst->invokeArgs(null, array($this->getCondition()));

	        if($info!=false) {
	            $this->view->setVar("info", $info);
	        }
	    }
	}

	function doDelete() {
	    $findFirst = new \ReflectionMethod($this->getModelName(), 'findFirst');
	    $row = $findFirst->invokeArgs(null, array($this->getCondition()));
	    
	    $result = array("code"=>200, "messages" => array());
	    if($row!=false) {
	        if ($row->delete() == false) {
	            $messages = $row->getMessages();

                foreach ($messages as $message) {
                    $result["messages"][] = $message->getMessage();
                }
	        }
	    }
	    echo json_encode($result);
        $this->view->disable();
	}
}
