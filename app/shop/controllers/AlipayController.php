<?php

namespace Multiple\Shop\Controllers;

use Asa\Erp\TbShoporderCommon;
use Yansongda\Pay\Log;
use Yansongda\Pay\Pay;

/**
 * 支付宝支付类
 * Class AlipayController
 * @package Multiple\Shop\Controllers
 */
class AlipayController extends AdminController
{
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
        } catch (\Exception $e) {
            // 传递错误
            $this->view->setVars([
                'title' => $this->getValidateMessage('error'),
                'message' => $this->getValidateMessage(1001),
            ]);
            return $this->view->pick('error/error');
        }

        // 返回
        $this->view->setVars([
            'title' => $this->getValidateMessage('success'),
            'message' => $this->getValidateMessage('payment-success'),
        ]);
        return $this->view->pick('error/error');
    }

    /**
     * 支付宝接收异步通知
     * @return mixed
     */
    public function notifyAction()
    {
        // 逻辑
        try {
            $data = $this->alipay->verify(); // 是的，验签就这么简单！
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
                return $this->alipay->success()->send();
            }

            // 记录日志
            $array_data = $data->all();
            Log::debug('Alipay notify', $array_data);

            // 更新订单状态为已支付，同时添加支付时间和异步通知数据
            $modify_data = ['pay_time' => $data->notify_time, 'payment_no' => $data->trade_no];
            // 下面这种情况非常少见，如果抽风写入失败，就放在下一次进行写入吧。
            if (!$order->save($modify_data)) {
                return 'fail';
            }

            // 返回成功信息给支付宝
            return $this->alipay->success()->send();
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }

}
