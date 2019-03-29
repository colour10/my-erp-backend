<?php

namespace Multiple\Shop\Controllers;

use Phalcon\Mvc\Controller;

use Asa\Erp\TbMember;

class LoginController extends AdminController
{

    public function initialize()
    {
    	
    }



	    function indexAction()
    {
    	
    }
    
     function loginAction()
    {
        if($this->request->isPost()) {
            //
            $username = $this->request->getPost('login_name');
            $password = $this->request->getPost('password');
            $rs = TbMember::findFirst(array(
            	"login_name = '$username' and password = '$password'"
            ));
            $res = $rs->toArray();
            if($rs->toArray()){
            	$this->session->set('member',$res);
            	echo json_encode(['code' => '200', 'auth' =>$this->session->get('member'), 'messages' => []]);
            }
            else {
                echo json_encode(['code' => '200', 'messages' => ["登录失败。用户名或密码错误。"]]);
            }
        }
    
    }
    
    function logoutAction()
    {
        $this->session->destroy();
        return $this->response->redirect("index/index");
    
    }
    
 
}
