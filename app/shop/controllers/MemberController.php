<?php

namespace Multiple\Shop\Controllers;

use Asa\Erp\TbMember;
use Asa\Erp\TbMemberAddress;
use Asa\Erp\Util;

/**
 * 会员操作类
 * Class MemberController
 * @package Multiple\Shop\Controllers
 */
class MemberController extends AdminController
{
    /**
     * 没有首页
     */
    public function indexAction()
    {
        // 逻辑
        // 验证是否登录
        if (!$member = $this->member) {
            return $this->response->redirect('/login');
        }
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
            // 是否登录
            if ($member = $this->member) {
                // 需要接受旧密码、新密码，确认新密码三个选项
                $old_password = $this->request->get('old_password');
                $new_password = $this->request->get('new_password');
                $repeat_password = $this->request->get('repeat_password');

                // 判断密码是否全部填写了
                if (!$old_password || !$new_password || !$repeat_password) {
                    return $this->error($this->getValidateMessage('password-required'));
                }
                // 判断新密码和确认密码是否相等
                if ($new_password != $repeat_password) {
                    return $this->error($this->getValidateMessage('password-not-equal'));
                }
                // 判断原始密码是否正确
                $model = TbMember::findFirstById($member['id']);
                if (!$model) {
                    return $this->error($this->getValidateMessage('member', 'template', 'notexist'));
                }
                if (md5($old_password) != $model->password) {
                    return $this->error($this->getValidateMessage('password-not-correct'));
                }

                // 开始写入数据库
                $data = [
                    'password' => md5($new_password),
                ];
                if (!$model->save($data)) {
                    return $this->error($this->getValidateMessage('member', 'db', 'save-failed'));
                }
                // 最终返回成功
                return $this->success();
            } else {
                // 报错
                return $this->error($this->getValidateMessage('model-delete-message'));
            }
        }

        // get请求，判断是否登录
        if (!$member = $this->member) {
            return $this->response->redirect('/login');
        }
    }
}