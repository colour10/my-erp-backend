<?php
namespace Multiple\Home\Controllers;

use Phalcon\Mvc\Controller;
use Phalcon\Mvc\View;
use Asa\Erp\User;

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
	        $username = $this->request->getPost('username');
            $password = $this->request->getPost('password');

            //Find the user in the database
            $user = User::findFirst(array(
                sprintf("username='%s' and password='%s'", addslashes($username), md5($password))
            ));

            if ($user!=false) {
                $this->session->set('user', array(
                    'id' => $user->id,
                    'username' => $user->username
                ));

                //Forward to the 'invoices' controller if the user is valid
                header("location:/");
            }
            else {
                return $this->dispatcher->forward(array(
                    'controller' => 'login',
                    'action' => 'index'
                ));
            }
	    }	    
	}
	
	function logoutAction() {
	    $this->session->destroy();
	    
	    header("location:/login");   
	}
}
