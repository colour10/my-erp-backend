<?php
namespace Multiple\Admin\Controllers;

use Phalcon\Mvc\Controller;
use Phalcon\Db\Column;
use  Phalcon\Mvc\Model\Message;

class AdminController extends Controller
{
    protected $modelName;
    protected $modelObject;

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
        echo 3388;
        $class = new \ReflectionClass($this->getModelName());
        var_dump($class->inNamespace());
var_dump($class->getName());
var_dump($class->getNamespaceName());
var_dump($class->getShortName());

        try {
            $instance = $class->newInstance();
            $instance->name = "Tom";
            $instance->age = 15;
            $instance->in_time = time();
            $instance->save();
        }
        catch(Exception $e) {
            echo $e->getMessage();   
        }
        echo 44;
        exit;
        $this->view->disable();
	}


	function editAction() {
	    //print_r($this->dispatcher->getParams());exit;
	    $this->doEdit();

	    echo "sd";exit;
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

	        if ($row->create() === false) {
                $messages = $row->getMessages();

                foreach ($messages as $message) {
                    echo 'Message: ', $message->getMessage();
                    echo 'Field: ', $message->getField();
                    echo 'Type: ', $message->getType();
                }
            }
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

    	        if ($row->save() === false) {
                    $messages = $row->getMessages();

                    foreach ($messages as $message) {
                        echo 'Message: ', $message->getMessage();
                        echo 'Field: ', $message->getField();
                        echo 'Type: ', $message->getType();
                    }
                }
    	    }
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
	    if($row!=false) {
	        $row->delete();
	    }
	}
}
