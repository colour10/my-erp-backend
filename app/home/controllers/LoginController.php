<?php
namespace Multiple\Home\Controllers;
use Phalcon\Mvc\Controller;
use Phalcon\Mvc\View;
use Asa\Erp\TbUser;

header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');
        header('Access-Control-Allow-Methods: Get,Post,Put,OPTIONS');
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
                $group = $user->group;

                $this->session->set('user', array(
                    'id' => $user->id,
                    'username' => $user->login_name,
                    'companyid' => $user->companyid,
                    'saleportid' => $user->saleportid,
                    'saleportids' => $user->saleportids,
                    'company' => $user->company,
                    'actions' => $group->getActionList()->toArray(),
                    'permissions' => $group->getPermissionList()->toArray(),
                    "language" => $_POST['language']
                ));
                //Forward to the 'invoices' controller if the user is valid
                //header("location:/");
                echo json_encode(['code' => '200', 'auth' =>$this->session->get('user'), "session_id" => $this->session->getId(), 'messages' => []]);
            }
            else {
                echo json_encode(['code' => '200', 'messages' => ["登录失败。用户名或密码错误。"]]);
            }
        }
        else {
            header("location:/");
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