<?php

namespace Multiple\Shop\Controllers;

use Asa\Erp\TbCompany;
use Asa\Erp\TbMember;
use Asa\Erp\TbMemberAddress;
use Asa\Erp\Util;
use Phalcon\Queue\Beanstalk;

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


    /**
     * 邀请注册
     * @return false|\Phalcon\Http\Response|\Phalcon\Http\ResponseInterface|\Phalcon\Mvc\View|string
     * @throws \PHPMailer\PHPMailer\Exception
     */
    public function inviteAction()
    {
        // 逻辑
        if ($this->request->isPost()) {
            // 是否登录
            if ($member = $this->member) {
                // 需要接受邮箱，用户名三个选项
                $email = $this->request->get('email');
                $username = $this->request->get('username');
                $companyid = $this->request->get('companyid');

                // 判断全部填写了
                if (!$email || !$username || !$companyid) {
                    return $this->error($this->getValidateMessage('fill-out-required-fields'));
                }

                // 邮箱和用户名不能重复
                $existsModel = TbMember::findFirst([
                    "email = :email: or name = :username: or login_name = :username:",
                    'bind' => [
                        'email' => $email,
                        'username' => $username,
                    ],
                ]);
                if ($existsModel) {
                    return $this->error($this->getValidateMessage('jibenziliao', 'template', 'uniqueness'));
                }

                // 默认密码是用户名+123
                $password = $username . '123';
                $bcrypt_password = md5($username . '123');

                // 开始写入数据库
                $data = [
                    'email' => $email,
                    'name' => $username,
                    'login_name' => $username,
                    'password' => $bcrypt_password,
                    'companyid' => $companyid,
                    // 添加邀请人
                    'invoteuser' => $member['id'],
                ];
                $model = new TbMember();
                if (!$model->create($data)) {
                    return $this->error($this->getValidateMessage('member', 'db', 'add-failed'));
                }

                // 自动发送一个注册邮件，使用队列进行处理
                $this->queue->choose('my_tube');
                $this->queue->put(Util::sendEmail($email, $this->getValidateMessage('notice-for-success-register'), $this->outputhtml($username, $password)), [
                    // 任务优先级
                    'priority' => 250,
                    // 延迟时间
                    'delay' => 10,
                    // 运行时间
                    'ttr' => 3600,
                ]);

                // 最终返回成功
                return $this->success();
            } else {
                // 报错
                return $this->error($this->getValidateMessage('model-delete-message'));
            }
        }

        // get请求，判断是否登录
        // 还要必须为虚拟公司的用户才行
        if (!$member = $this->member) {
            return $this->response->redirect('/login');
        } else {
            if (!$this->isadmin) {
                // 传递错误
                return $this->renderError('make-an-error', '404-not-found');
            }
        }
    }


    /**
     * 注册模板
     * @param string $username 用户名
     * @param string $password 密码
     * @return string
     */
    private function outputhtml($username, $password)
    {
        return <<<EOT
            <!Doctype html>
            <html lang="en">
            <head>
            <meta charset="UTF-8" />
            <title>{$this->getValidateMessage('notice-for-success-register')}</title>
            </head>
            <body>
                {$this->getValidateMessage('dear')}{$username}，{$this->getValidateMessage('thank-you-for-register')}~<br><br>
                
                {$this->getValidateMessage('default-password')}：{$password}，{$this->getValidateMessage('modify-in-time')}。<br><br>
                
                {$this->getValidateMessage('login-by-click-link')}：<br>
                
                <a href="http://{$this->shop_host}" target="_blank">http://{$this->shop_host}</a>
            </body>
        </html>
EOT;
    }


    /**
     * 邀请注册名单
     * @return \Phalcon\Mvc\View
     */
    public function invitelistAction()
    {
        // 逻辑
        if ($this->member['companyid'] != $this->supercoid) {
            return $this->renderError('make-an-error', '404-not-found');
        }
        $result = TbMember::find("invoteuser=" . $this->member['id']);
        $result_array = $result->toArray();
        foreach ($result->toArray() as $k => $v) {
            $result_array[$k]['companyname'] = ($company = TbCompany::findFirstById($this->member['companyid'])) ? $company->name : '';
        }
        // 传送给模板
        $this->view->setVars([
            'result' => $result_array,
        ]);
    }
}