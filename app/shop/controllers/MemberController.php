<?php

namespace Multiple\Shop\Controllers;

use Asa\Erp\TbMember;
use Asa\Erp\TbMemberAddress;

/**
 * 会员操作类
 * Class MemberController
 * @package Multiple\Shop\Controllers
 */
class MemberController extends AdminController
{
    /**
     * 默认首页
     */
    public function indexAction()
    {
        // 判断是否登录
        if (!$member = $this->session->get('member')) {
            return $this->dispatcher->forward([
                'controller' => 'login',
                'action' => 'index',
            ]);
        }
        // 向模板传值
        $this->view->setVars(compact('member'));
    }

    /**
     * 修改密码
     * @return false|string
     */
    public function resetpasswordAction()
    {
        // 逻辑
        if ($this->request->isPost()) {
            if ($member = $this->session->get('member')) {
                // 需要接受旧密码、新密码，确认新密码三个选项
                $old_password = $this->request->get('old_password');
                $new_password = $this->request->get('new_password');
                $repeat_password = $this->request->get('repeat_password');

                // 判断密码是否全部填写了
                if (!$old_password || !$new_password || !$repeat_password) {
                    $msg = $this->getValidateMessage('password-required');
                    return $this->error([$msg]);
                }
                // 判断新密码和确认密码是否相等
                if ($new_password != $repeat_password) {
                    $msg = $this->getValidateMessage('password-not-equal');
                    return $this->error([$msg]);
                }
                // 判断原始密码是否正确
                $model = TbMember::findFirstById($member['id']);
                if (!$model) {
                    $msg = $this->getValidateMessage('member', 'template', 'notexist');
                    return $this->error([$msg]);
                }
                if (md5($old_password) != $model->password) {
                    $msg = $this->getValidateMessage('password-not-correct');
                    return $this->error([$msg]);
                }

                // 开始写入数据库
                $data = [
                    'password' => md5($new_password),
                ];
                if (!$model->save($data)) {
                    $msg = $this->getValidateMessage('member', 'db', 'save-failed');
                    return $this->error([$msg]);
                }
                // 最终返回成功
                return $this->success();
            }
        }
    }

}