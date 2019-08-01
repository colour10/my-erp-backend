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
    /**
     * 聚合付款，二维码多合一
     * @param int $order_id
     * @return string|void
     */
    public function payAction(int $order_id)
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

    /**
     * 聚合付款，生成二维码
     * @param int $order_id
     * @return \Phalcon\Http\Response
     */
    public function createqrcodeAction(int $order_id)
    {
        // 逻辑
        return Util::createQrcode("http://www.myshop.com/pay/pay/" . $order_id);
    }
}
