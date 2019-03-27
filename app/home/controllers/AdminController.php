<?php

namespace Multiple\Home\Controllers;

use Asa\Erp\TbDepartment;
use Asa\Erp\TbUser;
use Phalcon\Mvc\Controller;
use Phalcon\Db\Column;
use  Phalcon\Mvc\Model\Message;

class AdminController extends BaseController
{
    protected $modelName;
    protected $modelObject;
    protected $list_key_column;
    protected $list_columns;
    protected $is_language = false;

    public function initialize() 
    {
	    parent::initialize();
    }

    function setModelName($modelName)
    {
        $this->modelName = $modelName;
    }

    function configList($key_column, $columns) 
    {
        $this->list_key_column = $key_column;
        $this->list_columns = $columns;
    }
    
    function setLanguageFlag($boolValue) {
        $this->is_language = $boolValue;
    }

    function getModelName()
    {
        return $this->modelName;
    }

    function getModelObject()
    {
        if (!$this->modelObject) {
            $class = new \ReflectionClass($this->getModelName());
            $this->modelObject = $class->newInstance();
        }

        return $this->modelObject;
    }

    function getAttributes()
    {
        $model = $this->getModelObject();

        try {
            $metaData = $model->getModelsMetaData();
            return $metaData->getAttributes($model);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
    
    function getSearchCondition()
    {
        $model = $this->getModelObject();
        $metaData = $model->getModelsMetaData();
        $primaryKeys = $metaData->getPrimaryKeyAttributes($model);
        $fieldTypes = $metaData->getDataTypes($model);
        
        //var_dump($fieldTypes);

        $array = $model->getSearchBaseCondition();

        foreach ($fieldTypes as $key=>$value) {
            if(isset($_REQUEST[$key]) && $_REQUEST[$key]!="" ) {
                if ($fieldTypes[$key] == Column::TYPE_INTEGER || $fieldTypes[$key] == Column::TYPE_BIGINTEGER ) {
                    $array[] = sprintf("%s=%d", $key, $this->request->get($key));
                } else { //($fieldTypes[$key] == Column::TYPE_CHAR || $fieldTypes[$key] == Column::TYPE_VARCHAR) {
                    $array[] = sprintf("%s='%s'", $key, addslashes($this->request->get($key)));
                }
            }
        }

        return implode(' and ', $array);
    }

    function getCondition()
    {
        $model = $this->getModelObject();
        $metaData = $model->getModelsMetaData();
        $primaryKeys = $metaData->getPrimaryKeyAttributes($model);
        $fieldTypes = $metaData->getDataTypes($model);

        $array = array();

        foreach ($primaryKeys as $key) {
            if ($fieldTypes[$key] == Column::TYPE_INTEGER || $fieldTypes[$key] == Column::TYPE_BIGINTEGER) {
                $array[] = sprintf("%s=%d", $key, $this->request->get($key));
            } else {//if ($fieldTypes[$key] == Column::TYPE_CHAR || $fieldTypes[$key] == Column::TYPE_VARCHAR || $fieldTypes[$key] == Column::TYPE_ENUM) {
                $array[] = sprintf("%s='%s'", $key, addslashes($this->request->get($key)));
            }
        }

        return implode(' and ', $array);
    }

    public function indexAction()
    {
	}
	
	function pageAction() {
	    $findFirst = new \ReflectionMethod($this->getModelName(), 'find');
	    $result = $findFirst->invokeArgs(null, array(
	        $this->getSearchCondition()
	    ));
        
        if($this->request->isAjax()) {
            //echo json_encode($result->toArray());

            echo $this->reportJson(array("data"=>$result->toArray()),200,[]);
        }
	}

	public function listAction() {
	    $this->doList();
	}

	public function doList($columns=array()) {
	    
	    if($this->request->isAjax()) {
	        $findFirst = new \ReflectionMethod($this->getModelName(), 'find');
	        
	        $where = $this->getSearchCondition();
	        //echo $where;exit;
	        
	        $result = $findFirst->invokeArgs(null, array($where));
	        
            
            $list = array();
            foreach($result as $row) { 
                $arr = $this->beforeOutputListLoop($row);
                if(is_array($arr)) {
                    $line = array_merge($row->toArray(), $arr);
                }
                else {
                    $line = $row->toArray();
                }
                
                
                if($this->list_key_column!="" && count($this->list_columns)>0) {
                    $column_name = $this->list_key_column;
                    $output_line = array();
                    //print_r($line);
                    foreach($this->list_columns as $name) {
	                    $output_line[$name] = $line[$name];
	                }
	                $list[$line[$column_name]] = $output_line;
                }
                else {
                    $list[] = $line;   
                }
            }           
            echo $this->reportJson(array("data"=>$list) );           
	    }
	    
	}
	
	function beforeOutputListLoop($row) {
	    
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
	            if(isset($_POST[$name]) && !preg_match("#^sys_#", $name)) {
	                $row->$name = $_POST[$name];
	            }
	        }

            $result = array("code"=>200, "messages" => array());
	        if ($row->create() === false) {
                $messages = $row->getMessages();

                foreach ($messages as $message) {
                    $result["messages"][] = $message->getMessage();
                }
            } else {
                $result['is_add'] = "1";
                $result['id'] = $row->id;
                //$message['idd'] = "999";
            }
            echo json_encode($result);
        }

    }

    function doEdit()
    {
        if ($this->request->isPost()) {
            //锟斤拷锟斤拷锟斤拷锟捷匡拷
            $findFirst = new \ReflectionMethod($this->getModelName(), 'findFirst');
            $row = $findFirst->invokeArgs(null, array($this->getCondition()));

            if ($row != false) {
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
    }
}
