<?php

use Asa\Erp\TbShoporderCommon;

/**
 * 延迟退款
 * Class RefundorderTask
 */
class RefundorderTask extends CommonTask
{
    /**
     * 队列名字
     *
     * @return string
     */
    public function getQueueName()
    {
        return 'my_refundorder_tube';
    }

    /**
     * 队列执行逻辑
     *
     * @param object $logger
     * @param object $job
     * @return mixed|void
     */
    public function run($logger, $job)
    {
        // 获取任务详情
        // 开始发送邮件
        $jobInfo = $job->getBody();
        // 转成数组
        // 提取出三个必要参数$order、$payment、$config
        $order = $jobInfo['order'];
        $payment = $jobInfo['payment'];
        $method = $jobInfo['method'];
        $config = $jobInfo['config'];

        // 开始执行退款
        // 判断该订单的支付方式
        switch ($method) {
            // 微信支付
            case 'wechat':
                // 生成退款订单号
                $refundNo = TbShoporderCommon::getAvailableRefundNo();
                // 用try，cache捕捉错误
                try {
                    $payment->refund([
                        'out_trade_no'  => $order->getOrderNo(), // 之前的订单流水号
                        'total_fee'     => $order->getFinalPrice() * 100, //原订单金额，单位分
                        'refund_fee'    => $order->getFinalPrice() * 100, // 要退款的订单金额，单位分
                        'out_refund_no' => $refundNo, // 退款订单号
                        // 微信支付的退款结果并不是实时返回的，而是通过退款回调来通知，因此这里需要配上退款回调接口地址
                        'notify_url'    => $config['pay']['wechat']['notify_url'],
                    ]);
                } catch (\Exception $e) {
                    // 定义退款失败
                    // 把失败原因记录日志
                    $logger->notice('订单号' . $order->getOrderNo() . '退款失败：' . $e->getMessage());
                    // 等待120秒后重新放入队列（秒数有待商榷，太频繁了容易对数据库造成很大压力）
                    $job->release(100, 120);
                }
                // 将订单状态改成退款中
                $order->save([
                    'refund_no'     => $refundNo,
                    'refund_status' => TbShoporderCommon::REFUND_STATUS_PROCESSING,
                ]);
                break;
            // 支付宝支付
            case 'alipay':
                // 用我们刚刚写的方法来生成一个退款订单号
                $refundNo = TbShoporderCommon::getAvailableRefundNo();
                // 调用支付宝支付实例的 refund 方法
                try {
                    // refund
                    $ret = $payment->refund([
                        'out_trade_no'   => $order->getOrderNo(), // 之前的订单流水号
                        'refund_amount'  => $order->getFinalPrice(), // 退款金额，单位元
                        'out_request_no' => $refundNo, // 退款订单号
                    ]);

                    // 根据支付宝的文档，如果返回值里有 sub_code 字段说明退款失败
                    if ($ret->sub_code) {
                        // 将退款失败的保存存入 extra 字段
                        // 首先取出原来的内容
                        $extra = $order->getExtra();
                        if (is_array($extra)) {
                            $extra['refund_failed_code'] = $ret->sub_code;
                        }
                        // 将订单的退款状态标记为退款失败
                        $order->save([
                            'refund_no'     => $refundNo,
                            'refund_status' => TbShoporderCommon::REFUND_STATUS_FAILED,
                            'extra'         => $extra,
                        ]);
                    } else {
                        // 将订单的退款状态标记为退款成功并保存退款订单号
                        $order->save([
                            'refund_no'     => $refundNo,
                            'refund_status' => TbShoporderCommon::REFUND_STATUS_SUCCESS,
                        ]);
                    }
                } catch (\Exception $e) {
                    // 定义退款失败
                    // 把失败原因记录日志
                    $logger->notice('订单号' . $order->getOrderNo() . '退款失败：' . $e->getMessage());
                    // 等待120秒后重新放入队列（秒数有待商榷，太频繁了容易对数据库造成很大压力）
                    $job->release(100, 120);
                }
                break;
            default:
                // 原则上不可能出现，这个只是为了代码健壮性
                // 取出错误信息
                $logger->notice('未知支付方式：' . PHP_EOL);
                $job->delete();
        }
    }
}
