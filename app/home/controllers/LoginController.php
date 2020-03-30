<?php

namespace Multiple\Home\Controllers;

use Asa\Erp\TbUser;
use Phalcon\Mvc\Controller;

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');
header('Access-Control-Allow-Methods: Get,Post,Put,OPTIONS');

/**
 * 登录逻辑控制器
 * Class LoginController
 * @package Multiple\Home\Controllers
 */
class LoginController extends Controller
{
    function loginAction()
    {
        if ($this->request->isPost()) {
            //
            $username = $this->request->getPost('username');
            $password = $this->request->getPost('password');
            // Find the user in the database
            $user = TbUser::findFirst([
                sprintf("login_name='%s' and password='%s'", addslashes($username), md5($password)),
            ]);

            if ($user != false) {
                $group = $user->group;
                $language = isset($_POST['language']) ? $_POST['language'] : 'cn';

                $this->session->set('user', [
                    'id'          => $user->id,
                    'is_super'    => $group->is_super,
                    'username'    => $user->login_name,
                    'companyid'   => $user->companyid,
                    'saleportid'  => $user->saleportid,
                    'saleportids' => $user->saleportids,
                    'company'     => $user->company,
                    'actions'     => $group->getActionList()->toArray(),
                    'permissions' => $group->getPermissionList()->toArray(),
                    "language"    => $language,
                ]);

                $this->session->set('language', $language);
                //Forward to the 'invoices' controller if the user is valid
                //header("location:/");
                echo json_encode(['code' => '200', 'auth' => $this->session->get('user'), "session_id" => $this->session->getId(), 'messages' => []]);
            } else {
                echo json_encode(['code' => '200', 'messages' => ["登录失败。用户名或密码错误。"]]);
            }
        } else {
            header("location:/");
        }
    }

    function logoutAction()
    {
        $this->session->destroy();

        echo json_encode(['code' => '200', 'messages' => []]);
    }

    function checkloginAction()
    {
        $auth = $this->session->get('user');
        if ($auth && $auth["id"] > 0) {
            echo json_encode(['code' => '200', 'auth' => $auth, 'messages' => []]);
        } else {
            echo json_encode(['code' => '200', 'messages' => []]);
        }
    }
}
