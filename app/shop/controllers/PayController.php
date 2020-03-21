<?php

namespace Multiple\Shop\Controllers;

use Asa\Erp\Util;
use Phalcon\Http\Response;

/**
 * 聚合支付类
 * Class PayController
 * @package Multiple\Shop\Controllers
 */
class PayController extends AdminController
{
    /**
     * 聚合付款，二维码多合一
     * @param int $order_id
     * @return string|void
     */
    public function payAction($order_id)
    {
        // 逻辑
        $header = $this->request->getHeader('User-Agent');
        // 判断访问方式
        if (strpos($header, "Alipay") !== false) {
            // 支付宝扫码
            return $this->dispatcher->forward(['controller' => 'alipay', 'action' => 'pay', 'params' => ['order_id' => $order_id]]);
        } else if (strpos($header, "MicroMessenger") !== false) {
            // 微信扫码
            return $this->dispatcher->forward(['controller' => 'wechatpay', 'action' => 'pay', 'params' => ['order_id' => $order_id]]);
        } else {
            // 其他途径，报错处理
            return $this->getValidateMessage('unknown_payment_method');
        }
    }

    /**
     * 聚合付款，生成二维码
     * @param int $order_id
     * @return Response
     */
    public function createqrcodeAction($order_id)
    {
        // 逻辑
        return Util::createQrcode("http://" . $this->config['app']['shop_host'] . "/pay/pay/" . $order_id);
    }
}
