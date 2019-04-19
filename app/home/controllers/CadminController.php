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

    function before_add() {
        $_POST['companyid'] = $this->companyid;
    }

    function before_edit($row) {
        if(isset($_POST['companyid']) || $row->companyid!=$this->companyid) {
            throw new \Exception("/1001/数据非法/");
        }
    }

    function before_delete($row) {
        if($row->companyid!=$this->companyid) {
            throw new \Exception('/1002/数据非法/');
        }
    }

    function before_page() {
        $_POST['companyid'] = $this->companyid;
    }
/*
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
	}*/
}
