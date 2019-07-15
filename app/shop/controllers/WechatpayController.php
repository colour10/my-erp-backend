<?php

namespace Multiple\Shop\Controllers;

use Asa\Erp\TbShoporderCommon;
use Yansongda\Pay\Log;

/**
 * 微信支付类
 * Class WechatpayController
 * @package Multiple\Shop\Controllers
 */
class WechatpayController extends AdminController
{
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
        // 如果这笔订单的状态是已付款，那么就无需再次支付了。
        if ($order->getPayTime()) {
            // 返回数据给支付宝
            return $this->wechat_pay->success()->send();
        }

        // 记录日志
        $array_data = $data->all();
        Log::debug('Wechat notify', $array_data);

        // 更新订单状态为已支付，同时添加支付时间和异步通知数据
        $order->setPayTime(date('Y-m-d H:i:s'))->setPaymentNo($data->transaction_id);
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
                $this->queue->put(json_encode([$email, $this->getValidateMessage('payment-success'), $this->paySuccessOutputhtml($username, $msg, $order->getId())]), [
                    // 任务优先级
                    'priority' => 250,
                    // 延迟时间，表示将job放入ready队列需要等待的秒数，10代表10秒
                    'delay' => 10,
                    // 运行时间，表示允许一个worker执行该job的秒数。这个时间将从一个worker 获取一个job开始计算
                    'ttr' => 3600,
                ]);
            }
        }

        // 返回成功信息给微信
        return $this->wechat_pay->success()->send();
    }

}
