<?php
namespace Multiple\Home\Controllers;

use Phalcon\Mvc\Controller;
use Phalcon\Mvc\View;
class BaseController extends Controller {
	public function initialize() {
	    //parent::initialize();
	    
        //����ѡ��
        $this->view->setVar("system_language", $this->language);
    }
}
