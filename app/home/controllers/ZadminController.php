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

    function before_edit($row) {
        $row->setValidateLanguage(isset($_REQUEST['lang']) ? $_REQUEST['lang'] : $this->default_language);
    }
}
