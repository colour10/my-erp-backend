<?php
namespace Multiple\Home\Controllers;

use Phalcon\Mvc\Controller;
use Phalcon\Mvc\View;
use Asa\Erp\TbAgeseason;

/**
 * 年代表
 */
class AgeseasonController extends AdminController {
    public function initialize() {
	    parent::initialize();

	    $this->setModelName('Asa\\Erp\\TbAgeseason');
	    //$this->configList("fullname", [ "name","sessionmark" ]);
    }
    
    function beforeOutputListLoop($row) {
	    return array(
	        "fullname" => sprintf("%s%s", $row->sessionmark, $row->name)   
	    );
	}

    function before_page() {
        $_POST["__orderby"] = "name desc,sessionmark desc";
    }
}
