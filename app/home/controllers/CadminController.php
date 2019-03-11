<?php
namespace Multiple\Home\Controllers;

use Phalcon\Mvc\Controller;
use Phalcon\Mvc\View;
use Phalcon\Db\Column;

/**
 * 各个公司私有数据的表的基类
 */
class CadminController extends AdminController { 
    protected $companyid;  
    public function initialize() {
	    parent::initialize();
	    
	    $auth = $this->auth;
	    if($auth) {
	        $this->companyid = (int)$auth["companyid"];
	    }
    }
    
    function indexAction() {
        $findFirst = new \ReflectionMethod($this->getModelName(), 'find');
	    $result = $findFirst->invokeArgs(null, array(
	        sprintf("sys_delete_flag=0 and lang_code='%s' and companyid=%d", addslashes($this->default_language), $this->companyid)
	    ));

	    $this->view->setVar("result", $result->toArray());
	    $this->view->setVar("default_language", $this->default_language);
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
	        $row->companyid = $this->companyid;

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
            $this->view->disable();
	    }
	}
	
	function loadAction() {
	    $findFirst = new \ReflectionMethod($this->getModelName(), 'findFirst');
	    $row = $findFirst->invokeArgs(null, array(
	        sprintf("sys_delete_flag=0 and companyid=%d", $this->companyid)
	    ));

	    if($row!=false) {   
	        echo json_encode($row->toArray());   
	    }
	    else {
	        echo '{}';   
	    }
	    $this->view->disable();
	}
	
	function getCondition()
    {
        $model = $this->getModelObject();
        $metaData = $model->getModelsMetaData();
        $primaryKeys = $metaData->getPrimaryKeyAttributes($model);
        $fieldTypes = $metaData->getDataTypes($model);

        $array = array(
            sprintf("companyid=%d and sys_delete_flag=0", $this->companyid)
        );

        foreach ($primaryKeys as $key) {
            if ($fieldTypes[$key] == Column::TYPE_INTEGER || $fieldTypes[$key] == Column::TYPE_BIGINTEGER || $fieldTypes[$key] == Column::TYPE_MEDIUMINTEGER || $fieldTypes[$key] == Column::TYPE_SMALLINTEGER || $fieldTypes[$key] == Column::TYPE_TINYINTEGER) {
                $array[] = sprintf("%s=%d", $key, $this->request->get($key));
            } else if ($fieldTypes[$key] == Column::TYPE_CHAR || $fieldTypes[$key] == Column::TYPE_VARCHAR || $fieldTypes[$key] == Column::TYPE_ENUM) {
                $array[] = sprintf("%s='%s'", $key, addslashes($this->request->get($key)));
            }
        }

        return implode(' and ', $array);
    }
    
    public function doList($columns=array()) {
	    if($this->request->isAjax()) {
	        $findFirst = new \ReflectionMethod($this->getModelName(), 'find');
	        
	        $_POST["companyid"] = $this->companyid;
	        $where = $this->getSearchCondition();
	        
	        $result = $findFirst->invokeArgs(null, array($where));

	        if($this->list_key_column!="" && count($this->list_columns)>0) {
	            $column_name = $this->list_key_column;
	            $list = array();
	            foreach($result as $row) {
	                $line = array();

	                foreach($this->list_columns as $name) {
	                    $line[$name] = $row->$name;
	                }
	                $list[$row->$column_name] = $line;
	            }

	            echo json_encode($list);
	        }
	        else {
	            echo json_encode($result->toArray());
	        }
	    }
	    $this->view->disable();
	}
}
