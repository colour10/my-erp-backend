<?php

/**
 * 用户操作类
 */

namespace Multiple\Api\Controllers;

use Phalcon\Mvc\Controller;

class UserController extends Controller
{
    /**
     * 判断是否登录
     */
    public function isloginAction()
    {
        echo 'ok';
    }

    public function loginAction()
    {
        if ($this->request->isPost()) {
            echo 'post提交';
        }
        echo '没有任何提交';
    }
}