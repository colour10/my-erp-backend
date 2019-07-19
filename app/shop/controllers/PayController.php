<?php

namespace Multiple\Shop\Controllers;

use Asa\Erp\Util;

/**
 * 聚合支付类
 * Class PayController
 * @package Multiple\Shop\Controllers
 */
class PayController extends AdminController
{
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
            return '未知支付方式';
        }
    }

    public function createqrcodeAction($order_id)
    {
        // 逻辑
        return Util::createQrcode("http://www.myshop.com/pay/pay/" . $order_id);
    }
}
