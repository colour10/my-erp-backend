<?php
namespace Multiple\Home\Controllers;

use Phalcon\Mvc\Controller;
use Phalcon\Db\Column;
use  Phalcon\Mvc\Model\Message;

class CommonController extends BaseController {    
    public function initialize() {
	    parent::initialize();
    }

	public function indexAction() {        
	}
	
	function currencyAction() {
	    $lang = $this->language;
	    
	    $result = array(
	        "language" => $lang['code'],
	        "currency" => (array)$lang["currency"]
	    );
	    echo json_encode($result);
        $this->view->disable();
	}
}
