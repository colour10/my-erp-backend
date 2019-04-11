<?php
namespace Multiple\Home\Controllers;

use Phalcon\Mvc\Controller;
use Phalcon\Mvc\View;
use Phalcon\Db\Column;

/**
 * 各个公司私有数据的表的基类
 */
class CadminController extends AdminController { 
    public function initialize() {
	    parent::initialize();
    }
        
    function doAdd() {
        //echo $this->companyid;exit;
        if($this->companyid<=0) {
            $this->error(array("数据错误"));
            exit;    
        }
        
	    if($this->request->isPost()) {
	        //更新数据库
	        if(!isset($_POST["companyid"]) || $_POST["companyid"]=="") {
	            $_POST["companyid"] =  $this->companyid;  
	        }
	        parent::doAdd();
	    }
	}
	
	function loadAction() {
	    $findFirst = new \ReflectionMethod($this->getModelName(), 'findFirst');
	    $row = $findFirst->invokeArgs(null, array(
	        sprintf("id=%d and companyid=%d", $_POST["id"], $this->companyid)
	    ));

	    if($row!=false) {   
	        echo $this->reportJson(["data" => $row->toArray()]);   
	    }
	    else {
	        echo '{}';   
	    }
	}
	
	function getCondition()
    {
        $model = $this->getModelObject();
        $metaData = $model->getModelsMetaData();
        $primaryKeys = $metaData->getPrimaryKeyAttributes($model);
        $fieldTypes = $metaData->getDataTypes($model);

        $array = array(
            sprintf("companyid=%d", $this->companyid)
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
    	
	function getSearchCondition() {
        if($this->request->isPost()) {
            if(!isset($_POST["land_code"])) {
                $_REQUEST["companyid"] = $this->companyid;
                $_POST["companyid"] = $this->companyid;
                //print_r($_POST);
            }
	    }  
	    return parent::getSearchCondition();
    }
}
