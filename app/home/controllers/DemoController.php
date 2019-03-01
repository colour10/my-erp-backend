<?php
namespace Multiple\Home\Controllers;

use Phalcon\Mvc\Controller;
use Phalcon\Mvc\View;
class DemoController extends Controller
{

	public function indexAction()
	{
        echo 33;
        
        print_r($_GET);
        $this->view->disable();
	}
	
	function autoCompleteAction() {
	    //$this->view->setRenderLevel(View::LEVEL_NO_RENDER);  
	    $this->view->disableLevel(
            array(
                View::LEVEL_LAYOUT      => true,
                View::LEVEL_MAIN_LAYOUT => true
            )
        ); 
	}
	
	function tableAction() {
	    //$this->view->setVar("name", $ddd)
	       
	}
}
