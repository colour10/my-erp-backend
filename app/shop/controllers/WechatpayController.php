<?php

namespace Multiple\Shop\Controllers;

use Asa\Erp\TbShoporderCommon;
use Asa\Erp\Util;
use Phalcon\Http\Response;
use Phalcon\Http\ResponseInterface;

/**
 * 微信支付类
 * Class WechatpayController
 * @package Multiple\Shop\Controllers
 */
class WechatpayController extends AdminController
{
    /**
     * 微信扫码付款
     * @param int $order_id
     * @return bool|Response
     */
    public function payAction($order_id)
    {
        // 逻辑
        // 首先关闭错误提示
        Util::closeDisplayErrors();
        // 订单不存在，则报错
        if (!$order = TbShoporderCommon::findFirst("id=" . $order_id)) {
            return $this->getValidateMessage('order', 'template', 'notexist');
        }

        // 判断订单状态是否正确
        if ($order->getPayTime() || $order->getClosed()) {
            return $this->getValidateMessage('shoporder-status-error');
        }

        // 请求参数
        $config = [
            // 订单编号，需保证在商户端不重复
            'out_trade_no' => $order->getOrderNo(),
            // 订单金额，单位分，支持小数点后两位
            'total_fee'    => $order->getFinalPrice() * 100,
            // 订单标题
            'body'         => $this->getValidateMessage('order') . ': ' . $order->getOrderNo(),
        ];

        // 调用微信支付
        try {
            // 扫码
            $result = $this->wechat_pay->scan($config);
            // 返回二维码图片
            return Util::createQrcode($result->code_url);
        } catch (\Exception $e) {
            // 生成错误提示二维码
            return $e->getMessage();
        }

    }


    /**
     * 微信接收异步通知
     * @return mixed
     */
    public function notifyAction()
    {
        // 逻辑
        $data = $this->wechat_pay->verify(); // 是的，验签就这么简单！
        // 请自行对 trade_status 进行判断及其它逻辑进行判断，在支付宝的业务通知中，只有交易通知状态为 TRADE_SUCCESS 或 TRADE_FINISHED 时，支付宝才会认定为买家付款成功。
        // 1、商户需要验证该通知数据中的out_trade_no是否为商户系统中创建的订单号；
        // 2、判断total_amount是否确实为该订单的实际金额（即商户订单创建时的金额）；
        // 3、校验通知中的seller_id（或者seller_email) 是否为out_trade_no这笔单据的对应的操作方（有的时候，一个商户可能有多个seller_id/seller_email）；
        // 4、验证app_id是否为该商户本身。
        // 5、其它业务逻辑情况

        // $data->out_trade_no 拿到订单流水号，并在数据库中查询
        $order = TbShoporderCommon::findFirst("order_no=" . $data->out_trade_no);
        // 正常来说不太可能出现支付了一笔不存在的订单，这个判断只是加强系统健壮性。
        if (!$order) {
            return 'fail';
        }

        // 如果订单状态已经关闭，那么说明用户是在订单快临近关闭时付款的，这个时候的付款无效，我们要给用户做退款处理
        if ($order->getClosed()) {
            if ($this->queue) {
                $this->queue->choose('my_refundorder_tube');
                // 只把必要的参数传递给队列即可，剩下的逻辑交给Beanstalk吧。
                // 因为命令行session，注入变量都不能访问，所以需要把所有数据都传递过去
                $this->queue->put([
                    'order'   => $order,
                    'method'  => 'wechat',
                    'payment' => $this->wechat_pay,
                    'config'  => $this->config,
                ], $this->config->queue->toArray());
            }
        }

        // 如果这笔订单的状态是已付款，那么就无需再次支付了。
        if ($order->getPayTime()) {
            // 返回数据给支付宝
            return $this->wechat_pay->success()->send();
        }

        // 更新订单状态为已支付，同时添加支付时间和异步通知数据
        $order->setPaymentMethod('wechat')->setPayTime(date('Y-m-d H:i:s'))->setPaymentNo($data->transaction_id);
        // 下面这种情况非常少见，如果抽风写入失败，就放在下一次进行写入吧。
        if (!$order->save()) {
            return 'fail';
        }

        // 开始给用户发送支付成功的邮件
        $memberModel = $order->getMember();
        $email = $memberModel->email;
        $username = $memberModel->name;
        $time = $order->getCreateTime();
        // 友好提示
        $msg = sprintf($this->getValidateMessage('order_has_been_paid'), $time);
        // 自动发送一个注册邮件，使用队列进行处理
        // 如果队列服务成功开启，则执行，否则不执行
        if ($email) {
            if ($this->queue) {
                $this->queue->choose('my_sendemail_tube');
                // 只把必要的参数传递给队列即可，剩下的逻辑交给Beanstalk吧。
                $this->queue->put(json_encode([$email, $this->getValidateMessage('payment-success'), $this->paySuccessOutputhtml($username, $msg, $order->getId())]), $this->config->queue->toArray());
            }
        }

        // 返回成功信息给微信
        return $this->wechat_pay->success()->send();
    }


    /**
     * 查询订单状态
     * @param $out_trade_no
     * @return false|Response|ResponseInterface|string
     */
    public function queryAction($out_trade_no)
    {
        // 逻辑
        $result = $this->wechat_pay->find(['out_trade_no' => $out_trade_no]);
        // 如果支付非成功，就显示状态
        if ($result->trade_state !== 'SUCCESS') {
            return $this->error($this->getValidateMessage($result->trade_state));
        }
        // 否则就是支付成功
        return $this->success($this->getValidateMessage($result->trade_state));
    }


    /**
     * 微信退款异步通知
     * @return string
     */
    public function refundnotifyAction()
    {
        // 给微信的失败响应
        $failXml = '<xml><return_code><![CDATA[FAIL]]></return_code><return_msg><![CDATA[FAIL]]></return_msg></xml>';
        $data = $this->wechat_pay->verify(null, true);

        // 没有找到对应的订单，原则上不可能发生，保证代码健壮性
        if (!$order = TbShoporderCommon::findFirst("order_no=" . $data['out_trade_no'])) {
            return $failXml;
        }
        // 判断是否成功
        if ($data['refund_status'] === 'SUCCESS') {
            // 退款成功，将订单退款状态改成退款成功
            $order->setRefundStatus(TbShoporderCommon::REFUND_STATUS_SUCCESS);
            $order->save();
        } else {
            // 退款失败，将具体状态存入 extra 字段，并表退款状态改成失败
            $extra = $order->getExtra();
            $extra['refund_failed_code'] = $data['refund_status'];
            $order->setExtra($extra)->setRefundStatus(TbShoporderCommon::REFUND_STATUS_FAILED);
            $order->save();
        }

        // 返回成功
        return $this->wechat_pay->success()->send();
    }

}
