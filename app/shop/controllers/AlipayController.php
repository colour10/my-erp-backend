<?php

namespace Multiple\Shop\Controllers;

use Asa\Erp\TbShoporderCommon;
use Asa\Erp\TbShoppayment;
use Asa\Erp\Util;
use Phalcon\Http\Response;
use Yansongda\Pay\Log;

/**
 * 支付宝支付类，因为是第三方应用，所以只支持当面付，也就是扫码和刷卡
 * Class AlipayController
 * @package Multiple\Shop\Controllers
 */
class AlipayController extends AdminController
{
    /**
     * 支付宝扫码支付
     * @param int $order_id
     * @return bool|Response
     */
    public function payAction(int $order_id)
    {
        // 逻辑
        Util::closeDisplayErrors();
        // 订单不存在，则报错
        if (!$order = TbShoporderCommon::findFirst("id=" . $order_id)) {
            return $this->getValidateMessage('order', 'template', 'notexist');
        }

        // 判断订单状态是否正确
        if ($order->getPayTime() || $order->getClosed()) {
            return $this->getValidateMessage('shoporder-status-error');
        }

        // 默认调用支付宝的网页支付，这个将会自动跳转到支付宝的付款页面
        // 请求参数
        $orderConfig = [
            // 订单编号，需保证在商户端不重复
            'out_trade_no' => $order->getOrderNo(),
            // 订单金额，单位元，支持小数点后两位
            'total_amount' => $order->getFinalPrice(),
            // 订单标题
            'subject'      => $this->getValidateMessage('order') . ': ' . $order->getOrderNo(),
        ];

        // 支付，这里要采用第三方授权支付。
        // 先看看tbshoppayment是否存储了支付参数，如果没有则给出提示
        if (!$this->app_auth_token) {
            // 返回卖家支付宝未授权，不能通过支付宝付款的错误信息
            return $this->getValidateMessage('seller-alipay-not-authorized');
        }

        // 开始支付
        try {
            $result = $this->alipay->scan($orderConfig);
            // 返回支付宝二维码内容
            return Util::createQrcode($result->qr_code);
        } catch (\Exception $e) {
            // 生成错误提示二维码
            return $e->getMessage();
        }

    }

    /**
     * 支付宝同步接收通知
     */
    public function returnAction()
    {
        // 校验提交的参数是否合法
        $data = $this->request->get();
        // phalcon框架会自动添加_url，这里需要删除_url才能校验成功
        if (isset($data['_url'])) {
            unset($data['_url']);
        }
        // 开始进行验签
        try {
            $this->alipay->verify($data);
            // 返回成功
            return $this->renderError('success', 'payment-success');
        } catch (\Exception $e) {
            // 传递错误
            return $this->renderError('error', 1001);
        }
    }

    /**
     * 支付宝接收异步通知
     * @return mixed
     */
    public function notifyAction()
    {
        // 逻辑
        $data = $this->alipay->verify(); // 是的，验签就这么简单！
        // 请自行对 trade_status 进行判断及其它逻辑进行判断，在支付宝的业务通知中，只有交易通知状态为 TRADE_SUCCESS 或 TRADE_FINISHED 时，支付宝才会认定为买家付款成功。
        // 1、商户需要验证该通知数据中的out_trade_no是否为商户系统中创建的订单号；
        // 2、判断total_amount是否确实为该订单的实际金额（即商户订单创建时的金额）；
        // 3、校验通知中的seller_id（或者seller_email) 是否为out_trade_no这笔单据的对应的操作方（有的时候，一个商户可能有多个seller_id/seller_email）；
        // 4、验证app_id是否为该商户本身。
        // 5、其它业务逻辑情况

        // 如果订单状态不是成功或者结束，则不走后续的逻辑
        // 所有校验状态：https://docs.open.alipay.com/59/103672
        if (!in_array($data->trade_status, ['TRADE_SUCCESS', 'TRADE_FINISHED'])) {
            return $this->alipay->success()->send();
        }

        // $data->out_trade_no 拿到订单流水号，并在数据库中查询
        $order = TbShoporderCommon::findFirst("order_no=" . $data->out_trade_no);
        // 正常来说不太可能出现支付了一笔不存在的订单，这个判断只是加强系统健壮性。
        if (!$order) {
            return 'fail';
        }
        // 如果这笔订单的状态是已付款，那么就无需再次支付了。
        if ($order->getPayTime()) {
            // 返回数据给支付宝
            return $this->alipay->success()->send();
        }

        // 记录日志
        $array_data = $data->all();
        Log::debug('支付宝订单号' . $data->trade_no . '的异步通知：', $array_data);

        // 更新订单状态为已支付，同时添加支付时间和异步通知数据
        $order->setPaymentMethod('alipay')->setPaymentNo($data->trade_no)->setPayTime($data->notify_time);
        // 下面这种情况非常少见，如果抽风写入失败，就放在下一次进行写入吧。
        if (!$order->save()) {
            return 'fail';
        }

        // 开始给用户发送支付成功的邮件
        $memberModel = $order->getMember();
        $email       = $memberModel->email;
        $username    = $memberModel->name;
        $time        = $order->getCreateTime();
        // 友好提示
        $msg = sprintf($this->getValidateMessage('order_has_been_paid'), $time);
        // 自动发送一个注册邮件，使用队列进行处理
        // 如果队列服务成功开启，则执行，否则不执行
        // 如果邮箱存在，才发邮件，否则就没有意义了
        if ($email) {
            if ($this->queue) {
                $this->queue->choose('my_sendemail_tube');
                // 只把必要的参数传递给队列即可，剩下的逻辑交给Beanstalk吧。
                $this->queue->put(json_encode([$email, $this->getValidateMessage('payment-success'), $this->paySuccessOutputhtml($username, $msg, $order->getId())]), [
                    // 任务优先级
                    'priority' => 250,
                    // 延迟时间，表示将job放入ready队列需要等待的秒数，10代表10秒
                    'delay'    => 10,
                    // 运行时间，表示允许一个worker执行该job的秒数。这个时间将从一个worker 获取一个job开始计算
                    'ttr'      => 3600,
                ]);
            }
        }

        // 返回成功信息给支付宝
        return $this->alipay->success()->send();
    }


    /**
     * 支付宝回调地址返回通知，生成授权码
     * 授权码一旦授权成功，就不能覆盖，只能删除之后重新授权
     * 是否授权成功，从数据库中提取，如果没有查询到记录，那么就说明没有授权；如果查到了记录说明授权成功了
     * @return Response|\Phalcon\Http\ResponseInterface|\Phalcon\Mvc\View
     */
    public function gettokenAction()
    {
        // get请求，判断是否登录
        if (!$member = $this->member) {
            return $this->response->redirect('/login');
        }

        // 逻辑
        // 第一步拼接授权链接.注意scope=auth_user的值一定要为auth_user 传别的值会报错无效授权令牌
        // https://openauth.alipaydev.com/oauth2/appToAppAuth.htm?app_id=2016072800109035&scope=auth_user&redirect_uri=https%3A%2F%2Fwww.alipay.com
        // 逻辑


        // 先把state存在Session中，防止csrf
        // 通过网站后台传入一个state参数，但是在支付宝后台因为无法传入state，所以需要授权两次
        // 新生成一个session
        if (!$this->session->has('state')) {
            $this->session->set('state', Util::create_uuid());
        }

        // 授权逻辑
        try {
            // 过滤CSRF
            if (!isset($_GET['state'])) {
                // 再次授权
                // 拼接跳转参数
                $redirect_uri = 'https://' . $this->config['pay']['alipay']['auth_url'] . '/oauth2/appToAppAuth.htm?app_id=' . $this->config['pay']['alipay']['app_id'] . '&state=' . $this->session->get('state') . '&redirect_uri=' . urlencode($_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . '/alipay/gettoken');

                //跳转获取code
                header("location:{$redirect_uri}");
            }

            // 赋给一个变量
            $code = trim($_GET['app_auth_code']);

            // 验证是否合法请求
            if ($this->session->get('state') != $_GET['state']) {
                return $this->renderError('make-an-error', 'illegal-source-request');
            }

            // session合法之后作废，防止重复授权
            $this->session->remove('state');

            // 判定appid是否是我们的
            if ($this->config['pay']['alipay']['app_id'] != $this->request->get('app_id')) {
                $msg = sprintf($this->getValidateMessage('missing-params'), 'app_id');
                return $this->renderError('make-an-error', $msg);
            }

            // 第一步：拼接授权链接，上一步已完成
            // http://openauth.alipay.com/oauth2/appToAppAuth.htm?app_id=您的appid&redirect_uri=您的授权回调地址

            // 第二步：访问授权链接获取auth_code
            // 传公共的参数
            // 首先获取aop
            $aop = $this->getAop();
            // 初始化换取app_auth_token接口
            $request = new \AlipayOpenAuthTokenAppRequest();
            // 请求的必传信息
            $request->setBizContent("{\"grant_type\":\"authorization_code\",\"code\":\"$code\"}");
            /**
             * 刷新app_auth_token的方法，app_auth_token有效期365天，如果过期需要重新授权,
             * 刷新令牌后我们会保证老的app_auth_token从刷新开始24小时内可继续使用，请及时替换为最新token
             * $request->setBizContent("{\"grant_type\":\"refresh_token\",\"code\":\"填写app_auth_token的值\"}");
             */
            $result       = $aop->execute($request);
            $responseNode = str_replace(".", "_", $request->getApiMethodName()) . "_response";
            // 转成数组
            $userToken = (array)$result->$responseNode;
            // 把companyid也放进去
            $userToken['companyid'] = $member['companyid'];
            if (empty($userToken['code']) || $userToken['code'] != 10000) {
                return $this->renderError('make-an-error', 'fail-to-get-userinfo');
            }

            // 第三步，查询这个应用授权AppAuthToken的授权信息，把结果记录到数组中
            $app_auth_token = $userToken['app_auth_token'];
            $request        = new \AlipayOpenAuthTokenAppQueryRequest ();
            $request->setBizContent("{" .
                "\"app_auth_token\":\"$app_auth_token\"" .
                "  }");
            $result       = $aop->execute($request);
            $responseNode = str_replace(".", "_", $request->getApiMethodName()) . "_response";
            $queryToken   = (array)$result->$responseNode;;
            if (empty($queryToken['code']) || $queryToken['code'] != 10000) {
                return $this->renderError('make-an-error', 'fail-to-get-token-info');
            }

            // 向数据库写入config
            // 判断是否授权了
            $payment = TbShoppayment::findFirst("companyid=" . $member['companyid']);
            // 如果不存在，则写入一条记录
            if (!$payment) {
                $payment = new TbShoppayment();
                $payment->setCompanyid($member['companyid']);
                $payment->save();
            }
            // 取出原来的内容，然后把alipayToken的部分添加进去
            $config                     = $payment->getConfig();
            $config['alipayUserToken']  = $userToken;
            $config['alipayQueryToken'] = $queryToken;
            $payment->setConfig($config);
            $payment->save();

            // 最终成功
            return $this->renderError('success', 'successful-authorization');
        } catch (\Exception $exception) {
            // 返回
            return $this->renderError('make-an-error', $exception->getMessage());
        }
    }


    /**
     * 获取授权用户基本信息
     * @return false|Response|\Phalcon\Http\ResponseInterface|\Phalcon\Mvc\View|string|void
     */
    public function getuserAction()
    {
        // 第一步拼接授权链接.注意scope=auth_user的值一定要为auth_user 传别的值会报错无效授权令牌
        // https://openauth.alipaydev.com/oauth2/publicAppAuthorize.htm?app_id=2016072800109035&scope=auth_user&redirect_uri=https%3A%2F%2Fwww.alipay.com
        // 逻辑
        // get请求，判断是否登录
        if (!$member = $this->member) {
            return $this->response->redirect('/login');
        }

        // 判断是否存在缓存，如果有，那么就无需重复获取了
        if (!$this->session->has('alipayUserData')) {
            // 判断是否有auth_code，如果不存在则跳转获取
            if (!isset($_GET['auth_code'])) {
                // 拼接跳转参数，注意scope=auth_user的值一定要为auth_user 传别的值会报错无效授权令牌
                $redirect_uri = 'https://' . $this->config['pay']['alipay']['auth_url'] . '/oauth2/publicAppAuthorize.htm?app_id=' . $this->config['pay']['alipay']['app_id'] . '&scope=auth_user&redirect_uri=' . urlencode($_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);

                //跳转获取code
                header("location:{$redirect_uri}");
            } else {
                // 存在auth_code就开始处理下面的逻辑
                try {
                    $code = trim($_GET['auth_code']);
                    if (empty($code)) {
                        $msg = sprintf($this->getValidateMessage('missing-params'), 'auth_code');
                        return $this->renderError('make-an-error', $msg);
                    }

                    // 获取access_token
                    $aop = $this->getAop();

                    // 第二步，首先获取access_token
                    $request = new \AlipaySystemOauthTokenRequest();
                    $request->setGrantType("authorization_code");
                    $request->setCode($code);

                    $result = $aop->execute($request);
                    // 转成数组
                    $result_arr   = json_decode(json_encode($result), true);
                    $responseNode = str_replace(".", "_", $request->getApiMethodName()) . "_response";
                    // 判断授权码是否已经过期
                    if (array_key_exists('error_response', $result_arr)) {
                        return $this->renderError('make-an-error', $result->error_response->sub_msg);
                    }
                    $resultData = (array)$result->$responseNode;
                    if (empty($resultData['access_token'])) {
                        $msg = sprintf($this->getValidateMessage('gain-error'), 'access_token');
                        return $this->renderError('make-an-error', $msg);
                    }

                    // 第三步，获取用户信息
                    $request        = new \AlipayUserInfoShareRequest();
                    $result         = $aop->execute($request, $resultData['access_token']);
                    $responseNode   = str_replace(".", "_", $request->getApiMethodName()) . "_response";
                    $alipayUserData = (array)$result->$responseNode;
                    if (empty($alipayUserData['code']) || $alipayUserData['code'] != 10000) {
                        // 记录log
                        Log::notice('支付宝获取用户信息失败：', $alipayUserData);
                        return $this->renderError('make-an-error', 'fail-to-get-userinfo');
                    }

                    // 把companyid加入进去
                    $alipayUserData['companyid'] = $member['companyid'];

                    // 向数据库写入config
                    // 判断是否授权了
                    $payment = TbShoppayment::findFirst("companyid=" . $member['companyid']);
                    // 如果不存在，则写入一条记录
                    if (!$payment) {
                        $payment = new TbShoppayment();
                        $payment->setCompanyid($member['companyid']);
                        $payment->save();
                    }
                    // 取出原来的内容，然后把alipayToken的部分添加进去
                    $config                   = $payment->getConfig();
                    $config['alipayUserData'] = $alipayUserData;
                    $payment->setConfig($config);
                    $payment->save();

                    // 返回
                    return $this->success($this->session->get('alipayUserData'));
                } catch (\Exception $exception) {
                    // 返回
                    return $this->error($exception->getMessage());
                }
            }
        } else {
            // 返回
            return $this->success($this->session->get('alipayUserData'));
        }
    }

    /**
     * 获取AOP对象，私有方法
     * @return \AopClient
     */
    private function getAop()
    {
        // 逻辑
        require_once APP_PATH . '/app/shop/packages/alipay/AopSdk.php';
        $aop                     = new \AopClient();
        $aop->appId              = $this->config['pay']['alipay']['app_id'];
        $aop->rsaPrivateKey      = $this->config['pay']['alipay']['private_key'];
        $aop->alipayrsaPublicKey = $this->config['pay']['alipay']['ali_public_key'];
        $aop->gatewayUrl         = $this->config['pay']['alipay']['gateway'];
        $aop->apiVersion         = '1.0';
        $aop->postCharset        = 'utf-8';
        $aop->format             = 'json';
        $aop->signType           = 'RSA2';
        // 返回
        return $aop;
    }

}
