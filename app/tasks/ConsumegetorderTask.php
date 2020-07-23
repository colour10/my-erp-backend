<?php

use Asa\Erp\TbOmsOrder;

/**
 * 接收 oms 发送过来的订单
 *
 * Class ConsumegetorderTask
 */
class ConsumegetorderTask extends CommonTask
{
    /**
     * 管道名称
     *
     * @return string
     */
    public function getQueueName()
    {
        return 'oms_get_order';
    }

    /**
     * 主要逻辑
     *
     * @param object $logger
     * @param object $job
     * @return mixed|void
     */
    public function run($logger, $job)
    {
        // 获取任务id
        $job_id = $job->getId();
        // 获取任务详情
        $jobInfo = $job->getBody();
        // 传送过来的是个json
        if (!$jobInfo) {
            // 如果为空，则报错并删除
            // 提示
            $logger->notice('Invalid oms order, Deleting...' . PHP_EOL);
            // 删除
            $job->delete();
        }
        // 把 json 转成数组
        $post = json_decode($jobInfo, true);
        // 记录日志
        error_log("\$post=" . print_r($post, true));
        $logger->notice("\$post=" . print_r($post, true));
        // 把 post 变量信息按照订单号写到对应的表中，然后分别处理
        // 以下信息全部来自于原始的 oms 发送过来的信息
        // 产品名称
        $productName = $post['Order']['OrderItems'][0]['ItemName'] ?? '';
        // 订单总金额
        $orderTotal = $post['Order']['OrderTotal'] ?? 0.00;
        // 收货人姓名
        $consignee = $post['Order']['Consignee'] ?? '';
        // 收货人电话
        $consignee_telephone = $post['Order']['ConsigneeTelephone'] ?? '';
        // 收货人地址
        $consignee_address = $post['Order']['ConsigneeAddress'] ?? '';
        // 颜色
        $color = $post['Order']['OrderItems'][0]['OrderItemDetails'][0]['Color'] ?? '';
        // 尺码
        $sizecontent_array = explode('|', $post['Order']['OrderItems'][0]['OrderItemDetails'][0]['AttributeSku']) ?? '';
        // 如果尺码不存在，就用空值代替
        $sizecontent = $sizecontent_array[1] ?? '';
        // 订单状态
        $orderStatus = $post['Order']['OrderStatusId'] ?? TbOmsOrder::STATUS_ORDER_PENDING;
        // 付款状态
        $paymentStatus = $post['Order']['PaymentStatusId'] ?? TbOmsOrder::STATUS_PAYMENT_UNPAID;
        // 下单时间
        $created_at = $post['Order']['CreatedOnUtc'];
        // 更新时间
        $updated_at = $post['Order']['UpdatedOnUtc'];
        // 记录上面各个变量的日志
        $logger->notice("\$productName=" . $productName);
        $logger->notice("\$orderTotal=" . $orderTotal);
        $logger->notice("\$consignee=" . $consignee);
        $logger->notice("\$consignee_telephone=" . $consignee_telephone);
        $logger->notice("\$consignee_address=" . $consignee_address);
        $logger->notice("\$color=" . $color);
        $logger->notice("\$sizecontent=" . $sizecontent);
        $logger->notice("\$orderStatus=" . $orderStatus);
        $logger->notice("\$paymentStatus=" . $paymentStatus);
        $logger->notice("\$created_at=" . $created_at);
        $logger->notice("\$updated_at=" . $updated_at);
        // 订单号必须存在，否则不执行
        if ($OrderNo = $post['Order']['OrderNo'] ?? '') {
            $model = TbOmsOrder::findFirst([
                'conditions' => 'orderNo = :orderNo:',
                'bind'       => [
                    'orderNo' => $OrderNo,
                ],
            ]);
            // 如果存在，则覆盖，否则新增
            if (!$model) {
                $m = new TbOmsOrder();
                // 订单号
                $m->orderNo = $OrderNo;
                $m->extra = $jobInfo;
                $m->productName = $productName;
                $m->orderTotal = $orderTotal;
                $m->consignee = $consignee;
                $m->consignee_telephone = $consignee_telephone;
                $m->consignee_address = $consignee_address;
                $m->color = $color;
                $m->sizecontent = $sizecontent;
                $m->orderStatus = $orderStatus;
                $m->paymentStatus = $paymentStatus;
                $m->created_at = $created_at;
                $m->updated_at = $updated_at;
                $m->create();
            } else {
                $model->extra = $jobInfo;
                $model->productName = $productName;
                $model->orderTotal = $orderTotal;
                $model->consignee = $consignee;
                $model->consignee_telephone = $consignee_telephone;
                $model->consignee_address = $consignee_address;
                $model->color = $color;
                $model->sizecontent = $sizecontent;
                $model->orderStatus = $orderStatus;
                $model->paymentStatus = $paymentStatus;
                $model->created_at = $created_at;
                $model->updated_at = $updated_at;
                $model->update();
            }
            // 返回成功
            $logger->notice('订单号' . $OrderNo . '有效，写入 tb_oms_order 表成功，请知悉...' . PHP_EOL);
        } else {
            // 如果订单号为空，则返回失败
            // 处理成功
            $logger->notice('订单号为空, 数据库更新失败！' . PHP_EOL);
        }
        // 删除该任务
        $job->delete();
        $logger->notice('成功执行任务，编号为： ' . $job_id . '的 Job 删除成功.' . PHP_EOL . PHP_EOL);
    }
}
