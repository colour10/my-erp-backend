<?php
namespace Multiple\Home\Controllers;

use Phalcon\Mvc\Controller;
use Phalcon\Mvc\View;
use Asa\Erp\ZlAgeseason;

/**
 * 年代表
 */
class AgeseasonController extends AdminController {
    public function initialize() {
	    parent::initialize();

	    $this->setModelName('Asa\\Erp\\ZlAgeseason');
	    //$this->configList("fullname", [ "name","sessionmark" ]);
    }
    
    function beforeOutputListLoop($row) {
	    return array(
	        "fullname" => sprintf("%s%s", $row->sessionmark, $row->name)   
	    );
	}
}
