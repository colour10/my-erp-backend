<?php

namespace Multiple\Shop\Controllers;

use Asa\Erp\TbCompany;
use Asa\Erp\TbMember;
use Asa\Erp\TbProductSearch;
use Asa\Erp\TbShoporderCommon;
use Asa\Erp\TbShoppayment;
use Phalcon\Paginator\Adapter\NativeArray as PaginatorArray;

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
     * 邀请注册的逻辑：
     * 1、超级用户邀请的用户，必须指定某个公司，且该公司自动成为这个公司的管理员
     * 2、普通用户邀请必须是公司管理员才行，邀请的用户默认是普通用户，不能再次邀请
     * @return false|\Phalcon\Http\Response|\Phalcon\Http\ResponseInterface|\Phalcon\Mvc\View|string
     */
    public function inviteAction()
    {
        // 逻辑
        if ($this->request->isPost()) {
            // 是否登录
            if ($member = $this->member) {
                // 需要接受邮箱，用户名两个选项，公司名称暂时用session的，也就是邀请人只能隶属于本公司
                $email = $this->request->get('email');
                $username = $this->request->get('username');
                // 对于companyid的判断，如果当前登录用户是超级用户，那么companyid就是传过来的$this->request->get('companyid')，如果是普通的公司管理员，那么就是当前用户登录的companyid
                if ($this->issuperadmin) {
                    $companyid = $this->request->get('companyid');
                    $membertype = '1';
                } else {
                    $companyid = $this->currentCompany;
                    $membertype = '0';
                }

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
                    'membertype' => $membertype,
                    // 添加邀请人
                    'invoteuser' => $member['id'],
                    // 是否锁库存
                    'is_lockstock' => $this->request->get('is_lockstock'),
                ];
                $model = new TbMember();
                if (!$model->create($data)) {
                    return $this->error($this->getValidateMessage('member', 'db', 'add-failed'));
                }

                // 自动发送一个注册邮件，使用队列进行处理
                // 如果队列服务成功开启，则执行，否则不执行
                if ($this->queue) {
                    $this->queue->choose('my_sendemail_tube');
                    // 只把必要的参数传递给队列即可，剩下的逻辑交给Beanstalk吧。
                    $this->queue->put(json_encode([$email, $this->getValidateMessage('notice-for-success-register'), $this->outputhtml($username, $password)]), [
                        // 任务优先级
                        'priority' => 250,
                        // 延迟时间，表示将job放入ready队列需要等待的秒数，10代表10秒
                        'delay' => 10,
                        // 运行时间，表示允许一个worker执行该job的秒数。这个时间将从一个worker 获取一个job开始计算
                        'ttr' => 3600,
                    ]);
                }


                // 最终返回成功
                return $this->success();
            } else {
                // 报错
                return $this->error($this->getValidateMessage('model-delete-message'));
            }
        }

        // get请求，判断是否登录
        // 还要必须公司用户才行
        if (!$member = $this->member) {
            return $this->response->redirect('/login');
        } else {
            if (!$member['membertype']) {
                // 传递错误
                return $this->renderError('make-an-error', '404-not-found');
            } else {
                // 把当前公司模型传递进去
                $this->view->setVars(['host' => $this->host]);
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
            <style>
            a {
                display: block;
                height: 40px;
                line-height:40px;
                width: 90px;
				text-align: center;
                background: #33af7b;
                color: #ffffff;
                font-size: 14px;
                font-weight: bold;
                text-decoration: none !important;
                padding-top: 3px;
                margin-top:3px;
            }
            </style>
            </head>
            <body>
                {$this->getValidateMessage('dear')}{$username}，{$this->getValidateMessage('thank-you-for-register')}~<br><br>
                
                {$this->getValidateMessage('default-password')}：{$password}，{$this->getValidateMessage('modify-in-time')}。<br><br>
                
                 <a href="http://{$this->shop_host}" target="_blank">登 录</a>
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
        // 判断是否为公司用户，如果是个人用户则报错
        // 如果列表中存在公司用户，那么就添加一个发送支付宝授权的功能
        if ($member = $this->member && $this->member['membertype'] > 0) {
            $result = TbMember::find("invoteuser=" . $this->member['id']);
            $result_array = $result->toArray();
            foreach ($result->toArray() as $k => $v) {
                $result_array[$k]['companyname'] = ($company = TbCompany::findFirstById($this->member['companyid'])) ? $company->name : '';
            }
            // 传送给模板
            $this->view->setVars([
                'result' => $result_array,
            ]);
        } else {
            return $this->renderError('make-an-error', '404-not-found');
        }
    }

    /**
     * 订单列表
     * @return \Phalcon\Http\Response|\Phalcon\Http\ResponseInterface|\Phalcon\Mvc\View
     */
    public function ordersAction()
    {
        // 逻辑
        // get请求，判断是否登录
        if (!$member = $this->member) {
            return $this->response->redirect('/login');
        }

        // 还要必须公司用户才行
        if (!$member['membertype']) {
            // 传递错误
            return $this->renderError('make-an-error', '404-not-found');
        }

        // 分页
        $currentPage = $this->request->getQuery("page", "int", 1);

        // 找到所有的订单，并且按照创建时间倒叙排列
        $orders = TbShoporderCommon::find([
            'conditions' => 'company_id = ' . $member['companyid'],
            'order' => 'create_time DESC',
        ]);

        // 整合子订单
        $orders_array = $orders->toArray();
        foreach ($orders as $k => $order) {
            $orders_array[$k]['orderdetails'] = $order->getShoporder()->toArray();
            // 下单人
            $member = $order->getMember();
            $orders_array[$k]['member_name'] = $member->name;
            // 是否显示更改截止时间
            // 要求是锁库存用户，未付款订单，有截止时间，并且截止时间有效，还有就是订单不能是关闭状态
            $orders_array[$k]['is_show_change_expiretime'] = ($member->is_lockstock && !$order->getPayTime() && $order->getExpireTime() && $order->getExpireTime() > date('Y-m-d H:i:s') && !$order->getClosed()) ? true : false;
            // 显示付款状态
            $orders_array[$k]['pay_status'] = $order->getPayTime() ? $this->getValidateMessage('paid') : $this->getValidateMessage('not-paid');
            // 显示物流状态
            $orders_array[$k]['ship_status'] = $this->getValidateMessage('ship_status_' . $order->getShipStatus());
            // 是否显示发货按钮
            $orders_array[$k]['is_show_ship_button'] = $order->isShowShipButton();
            // 显示退款状态
            $orders_array[$k]['refund_status'] = $this->getValidateMessage('refund_status_' . $order->getRefundStatus());
            // 子订单加入额外信息
            foreach ($orders_array[$k]['orderdetails'] as $key => $value) {
                // 封面图
                $orders_array[$k]['orderdetails'][$key]['picture'] = $this->file_prex . $value['picture'];
                // id
                $orders_array[$k]['orderdetails'][$key]['product_detail_id'] = $value['product_id'];
            }
        }

        // 创建分页对象，使用数组分页
        $paginator = new PaginatorArray(
            [
                "data" => $orders_array,
                "limit" => 5,
                "page" => $currentPage,
            ]
        );

        // 展示分页
        $page = $paginator->getPaginate();

        // 分配给模板
        $this->view->setVars([
            'orders' => $orders_array,
            'page' => $page,
        ]);
    }


    /**
     * 支付授权
     * @return \Phalcon\Http\Response|\Phalcon\Http\ResponseInterface|\Phalcon\Mvc\View
     */
    public function payauthAction()
    {
        // 逻辑
        // get请求，判断是否登录
        // 还要必须公司用户才行
        if (!$member = $this->member) {
            return $this->response->redirect('/login');
        } else {
            if (!$member['membertype']) {
                // 传递错误
                return $this->renderError('make-an-error', '404-not-found');
            }
        }

        // 判断是否授权了
        $payment = TbShoppayment::findFirst("companyid=" . $member['companyid']);
        // 如果不存在，则写入一条记录
        if (!$payment) {
            $payment = new TbShoppayment();
            $payment->setCompanyid($member['companyid']);
            $payment->save();
        }
        $config = $payment ? $payment->getConfig() : '';
        // 查找里面是否有app_auth_token字段
        $is_alipay_allow_auth = (strpos($config, 'app_auth_token') !== false) ? true : false;
        $is_wechatpay_allow_auth = (strpos($config, 'wx_app_auth_token') !== false) ? true : false;
        // 判断支付宝是否已授权
        if (!$is_alipay_allow_auth) {
            $alipay_url = '<a class="btn-custom" href="/alipay/gettoken" target="_blank">支付宝授权</a>';
        } else {
            $alipay_url = '<a class="btn-custom disabled" href="javascript:void(0);">支付宝已授权</a>';
        }

        // 判断微信是否已授权
        if (!$is_wechatpay_allow_auth) {
            $wechat_url = '<a class="btn-custom" href="/wechat/gettoken" target="_blank">微信支付授权</a>';
        } else {
            $wechat_url = '<a class="btn-custom disabled" href="javascript:void(0);">微信支付已授权</a>';
        }

        // 发送给模板
        $url = ['alipay_url' => $alipay_url, 'wechat_url' => $wechat_url];
        $this->view->setVars(compact('url'));
    }
}