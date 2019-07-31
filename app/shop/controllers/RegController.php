<?php

namespace Multiple\Shop\Controllers;

use Asa\Erp\TbMember;
use Asa\Erp\TbMemberAddress;
use Asa\Erp\Util;

/**
 * 会员注册类
 * Class RegController
 * @package Multiple\Shop\Controllers
 */
class RegController extends AdminController
{
    /**
     * 邀请注册
     * 用户会通过一个邀请链接进入到注册页面，系统会先检测是否之前邀请过这个邮箱进行注册，如果有邀请记录则允许注册，否则就返回一个错误页面
     * 邀请地址类似于：http://www.myshop.com/reg?invitation_email=84299915@qq.com&c=UA==
     * @return false|\Phalcon\Http\Response|\Phalcon\Http\ResponseInterface|\Phalcon\Mvc\View|string|void
     */
    public function indexAction()
    {
        // 逻辑
        // 如果是post提交
        if ($this->request->isPost()) {
            // 把密码写入，用户名写入数据库
            // 接收变量
            $username = $this->request->get('name');
            $email = $this->request->get('email');
            $c = $this->request->get('c');
            $password = $this->request->get('password');
            $repeat_password = $this->request->get('repeat_password');

            // 验证合法性
            if (!$username || !$password || !$repeat_password) {
                return $this->error($this->getValidateMessage('fill-out-required-fields'));
            }
            if ($password != $repeat_password) {
                return $this->error($this->getValidateMessage('password-not-equal'));
            }

            // 判断用户名是否唯一
            if (TbMember::findFirst([
                "name = :name:",
                'bind' => [
                    'name' => $username,
                ],
            ])) {
                return $this->error($this->getValidateMessage('member-exist'));
            }

            // 检查逻辑
            $result = $this->checkIfInvitationCorrect($email, $c);
            // 如果是字符串，则说明出错了，那么就用ajax返回
            if (is_string($result)) {
                return $this->error($result);
            }

            // 开始写入
            $companyid = Util::strCode($c, 'DECODE');
            $password = md5($password);
            $sql = "UPDATE tb_member SET login_name = '$username', name = '$username', password = '$password' WHERE email = '$email' AND companyid = $companyid";
            if (!$this->db->execute($sql)) {
                return $this->error($this->getValidateMessage('member', 'db', 'save-failed'));
            } else {
                return $this->success();
            }
        }

        // get模板请求
        // 不能处于登录状态
        if ($this->member) {
            return $this->renderError('tips', 'login-status-cannot-signup');
        }

        // 开始验证参数
        $email = $this->request->get('invitation_email');
        $c = $this->request->get('c');

        // 检查逻辑
        $result = $this->checkIfInvitationCorrect($email, $c);
        // 如果是字符串，则说明出错了，那么就用模板返回
        if (is_string($result)) {
            // 传递错误
            return $this->renderError('make-an-error', $result);
        }

        // 模板赋值
        $this->view->setVars([
            'email' => $email,
            'c' => $c,
        ]);
    }

    /**
     * 检查$email和$companyid的合法性，是否需要注册逻辑的验证
     * @param $email
     * @param $companyid
     * @return \Phalcon\Mvc\Model|string
     */
    private function checkIfInvitationCorrect($email, $companyid)
    {
        // 逻辑
        // 判断是否存在该email和companyid
        if (!$email || !$companyid) {
            // 报错
            return $this->getValidateMessage('params-error');
        }
        // 如果存在但是和数据库不符，也报错
        if (!$memberModel = TbMember::findFirst([
            "email = :email: and companyid = :companyid:",
            'bind' => [
                'email' => $email,
                'companyid' => Util::strCode($companyid, 'DECODE'),
            ],
        ])) {
            // 报错
            return $this->getValidateMessage('invitation-link-error');
        }
        // 再判断是否已经注册了，如果不为空说明已经注册了，无需再次注册
        if (!empty($memberModel->login_name) || !empty($memberModel->name) || !empty($memberModel->password)) {
            // 传递错误
            return $this->getValidateMessage('do-not-re-register');
        }
        // 如果以上都准确无误，就返回当前模型
        return $memberModel;
    }

}