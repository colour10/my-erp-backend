<?php

namespace Multiple\Shop\Controllers;

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
     * 登录首页
     * @return \Phalcon\Http\Response|\Phalcon\Http\ResponseInterface|void
     */
    public function indexAction()
    {
        // 如果已经登录，则直接跳转到首页
        if ($this->member) {
            return $this->response->redirect('/');
        }
    }

    /**
     * 会员登录逻辑
     * @return false|string
     */
    public function loginAction()
    {
        // 采用post接收
        if ($this->request->isPost()) {
            // 接收变量
            $username = $this->request->get('login_name');
            $password = $this->request->get('password');
            $language = $this->request->get('language');

            // 验证合法性
            if (!$username || !$password) {
                return $this->error($this->getValidateMessage('fill-out-required-fields'));
            }

            // 查找记录
            // 我们规定，用户名，昵称或者邮箱都可以登录
            $rs = TbMember::findFirst([
                "(name = :username: or login_name = :username: or email = :username:) and password = :password:",
                'bind' => [
                    'username' => $username,
                    'password' => md5($password),
                ],
            ]);

            // 分别返回
            if ($rs) {
                // 加入session
                $language = $language ?: 'cn';
                $this->session->set('language', $language);
                $this->session->set('member', $rs->toArray());
                return json_encode(['code' => '200', 'auth' => $this->session->get('member'), 'messages' => []]);
            } else {
                return $this->error($this->getValidateMessage('login-failed'));
            }
        }
    }

    /**
     * 退出登录
     */
    public function logoutAction()
    {
        // 退出登录则清除session
        $this->session->destroy();
        return $this->response->redirect('/login');
    }

}
