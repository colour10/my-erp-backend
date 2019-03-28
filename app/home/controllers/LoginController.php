<?php
namespace Multiple\Home\Controllers;
use Phalcon\Mvc\Controller;
use Phalcon\Mvc\View;
use Asa\Erp\TbUser;
class LoginController extends Controller
{
    function loginAction() {
        if($this->request->isPost()) {
            //
            $username = $this->request->getPost('username');
            $password = $this->request->getPost('password');
            //Find the user in the database
            $user = TbUser::findFirst(array(
                sprintf("login_name='%s' and password='%s'", addslashes($username), md5($password))
            ));
            if ($user!=false) {
                $this->session->set('user', array(
                    'id' => $user->id,
                    'username' => $user->login_name,
                    'companyid' => $user->companyid,
                    'saleport' => $user->saleport
                ));
                //Forward to the 'invoices' controller if the user is valid
                //header("location:/");
                echo json_encode(['code' => '200', 'auth' =>$this->session->get('user'), 'messages' => []]);
            }
            else {
                echo json_encode(['code' => '200', 'messages' => ["登录失败。用户名或密码错误。"]]);
            }
        }
    }

    function logoutAction() {
        $this->session->destroy();

        echo json_encode(['code' => '200', 'messages' => []]); 
    }

    function checkloginAction() {

        $auth = $this->session->get('user');
        if($auth && $auth["id"]>0) {
            echo json_encode(['code' => '200', 'auth' =>$auth, 'messages' => []]);
        }
        else {
            echo json_encode(['code' => '200', 'messages' => []]); 
        }
    }
}