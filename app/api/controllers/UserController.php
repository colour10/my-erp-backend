<?php

/**
 * 用户操作类
 */

namespace Multiple\Api\Controllers;

use Asa\Erp\User;
use Multiple\Api\Controllers\BaseController;

class UserController extends BaseController
{
    /**
     * 判断是否登录
     */
    public function isloginAction()
    {
        return $this->sendJson(['a' => '1', 'b' => '2']);
    }

    /**
     * 登录逻辑
     */
    public function loginAction()
    {
        // 判断是否post提交
        if ($this->request->isPost()) {
            // 用户名
            if (!$this->request->get('username')) {
                return $this->common->error('用户名未填写');
            }
            // 密码
            if (!$this->request->get('password')) {
                return $this->common->error('密码未填写');
            }
            // 开始验证
            $username = $this->request->get('username');
            $password = $this->request->get('password');
            $user = User::findFirst(['username' => $username, 'password' => $password]);
            // 如果不存在
            if (!$user) {
                return $this->common->error('用户不存在');
            } else {
                // 登录成功，写入session
                $this->session->set('user', $user->toArray());
                return $this->common->success($this->session->get('user'));
            }
        }
    }

    public function add()
    {

    }
}