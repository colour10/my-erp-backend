<?php
namespace Multiple\Home\Controllers;

use Phalcon\Mvc\Controller;
use Phalcon\Mvc\View;
use Asa\Erp\TbUser;

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
            $user = TbUser::findFirst(array(
                sprintf("login_name='%s' and password='%s' and sys_delete_flag=0", addslashes($username), md5($password))
            ));

            if ($user!=false) {
                $this->session->set('user', array(
                    'id' => $user->id,
                    'username' => $user->login_name,
                    'companyid' => $user->companyid
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
