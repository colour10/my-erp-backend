<?php

namespace Multiple\Shop\Controllers;

use Phalcon\Mvc\Controller;
use Asa\Erp\TbMember;

/**
 * 会员登录类
 * Class LoginController
 * @package Multiple\Shop\Controllers
 */
class LoginController extends AdminController
{

    /**
     * 初始化
     */
    public function initialize()
    {
    	
    }

    /**
     * 登录页面
     */
	public function indexAction()
    {
    	
    }

    /**
     * 会员登录逻辑
     * @return false|string
     */
     function loginAction()
    {
        // 采用post接收
        if($this->request->isPost()) {

            // 接收变量
            $username = $this->request->get('login_name');
            $password = $this->request->get('password');

            // 验证合法性
            if (!$username || !$password) {
                return json_encode(['code' => '200', 'messages' => ['用户名或密码不能为空']]);
            }

            // 加密
            $new_password = md5($password);
            // 查找记录
            $rs = TbMember::findFirst(array(
            	"login_name = '$username' and password = '$new_password'"
            ));

            // 分别返回
            if($rs){
            	$this->session->set('member',$rs->toArray());
            	return json_encode(['code' => '200', 'auth' =>$this->session->get('member'), 'messages' => []]);
            } else {
                return json_encode(['code' => '200', 'messages' => ["登录失败：用户名或密码错误。"]]);
            }
        }
    
    }

    /**
     * 退出登录
     * @return \Phalcon\Http\Response|\Phalcon\Http\ResponseInterface
     */
    function logoutAction()
    {
        $this->session->destroy();
        return $this->dispatcher->forward([
            'controller' => 'login',
            'action' => 'index',
        ]);
    }
    
 
}
