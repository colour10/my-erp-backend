<?php
namespace Multiple\Home\Controllers;

use Phalcon\Mvc\Controller;
use Phalcon\Mvc\View;

class LoginController extends Controller
{
	public function indexAction() {
	    $this->view->disableLevel(
            View::LEVEL_MAIN_LAYOUT
        );
	}
	
	function loginAction() {
	    if($this->request->isPost()) {
	        //µÇÂ¼ÑéÖ¤   
	    }	    
	}
	
	function logoutAction() {
	    $this->session->destroy();
	    
	    header("location:/login");   
	}
}
