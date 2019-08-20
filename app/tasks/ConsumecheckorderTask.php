<?php

use Asa\Erp\TbProductSearch;
use Asa\Erp\TbShoporderCommon;

/**
 * 轮询订单状态，及时处理未付款的订单
 * Class ConsumecheckorderTask
 */
class ConsumecheckorderTask extends CommonTask
{
    public function getQueueName()
    {
        return 'my_checkorder_tube';
    }

    public function do($logger, $job)
    {
        // 获取任务id
        $job_id = $job->getId();
        // 获取任务详情
        $jobInfo = $job->getBody();
        // 根据订单号去查找这个订单
        // 如果存在，则检查订单状态；如果已经付款，则删除队列；如果未付款，则判断是否已经超时，如果超时，则关闭订单，还原库存，并删除该队列任务
        // 如果推送过来的没有订单号，则报错
        if (!$jobInfo) {
            // 如果不存在订单号，则直接删除队列任务
            // 提示
            $logger->notice('Invalid Orderid, Deleting...' . PHP_EOL);
            // 删除
            $job->delete();
        }

        // 如果订单存在，则继续执行下面的逻辑
        // 取出订单model，因为要进行写入，所以采用悲观锁暂时锁定其状态，防止外界正在对其进行操作干扰程序正常运行。
        $orderModel = TbShoporderCommon::findFirst([
            'conditions' => 'id=' . $jobInfo,
            'for_update' => true,
        ]);

        // 判断数据库是否存在该订单记录
        if (!$orderModel) {
            $logger->notice('Orderid ' . $jobInfo . ' does not exist, Deleting...' . PHP_EOL);
            $job->delete();
        }

        // 继续判断该订单是否已经支付
        if ($orderModel->getPayTime()) {
            $logger->notice('Orderid ' . $jobInfo . ' is not unpaid, Deleting...' . PHP_EOL);
            $job->delete();
        }

        // 判断订单状态是否已经关闭了
        if ($orderModel->getClosed()) {
            $logger->notice('Orderid ' . $jobInfo . ' is closed, Deleting...' . PHP_EOL);
            $job->delete();
        }

        // 判断订单截止时间是否已经到了
        // 如果没有到截止时间，那么就10秒钟后再重新放入队列执行
        if ($orderModel->getExpireTime() > date('Y-m-d H:i:s')) {
            // 等待10秒后重新放入队列（秒数有待商榷，太频繁了容易对数据库造成很大压力）
            $job->release(100, 10);
        } else {
            // 执行到这里说明已经过期了，开始写入失效状态，并且还原库存
            // 开始写取消订单和还原库存的逻辑
            $this->db->begin();
            // 变更状态，走队列的都是系统自动处理，所以无需修改订单的过期时间
            // 把订单关闭
            $orderModel->setClosed(1);
            if (!$orderModel->save()) {
                // 回滚
                $this->db->rollback();
                // 如果写入失败，则过一会再处理，先报错
                $logger->notice('Orderid ' . $jobInfo . ' save failed, Waiting for retry...' . PHP_EOL);
                // 等待10秒后重新放入队列
                $job->release(100, 10);
            }
            // 订单更新成功日志
            $logger->notice('Orderid ' . $jobInfo . ' closed success, Waiting for stock reduction...' . PHP_EOL);
            // 开始执行锁定库存还原逻辑
            $is_lockstock = $orderModel->member->is_lockstock;
            // 如果下单人不涉及到库存还原，那么就无需进行此操作
            if ($is_lockstock) {
                $logger->notice('Orderid ' . $jobInfo . ' is required to reback the stock, Please waiting...' . PHP_EOL);
                // 取出每个订单下面具体商品信息
                $shoporders = $orderModel->shoporder;
                // 锁定库存还原
                foreach ($shoporders as $shoporder) {
                    // 执行写入，为了安全，这里采用悲观锁进行处理
                    $productSearchModel = TbProductSearch::findFirst([
                        'conditions' => 'id=' . $shoporder->product_id,
                        'for_update' => true,
                    ]);
                    // 商品不存在回滚
                    if (!$productSearchModel) {
                        // 回滚
                        $this->db->rollback();
                        // 商品不在了则直接删除
                        $logger->notice('Product does not exist, Deleting...' . PHP_EOL);
                        $job->delete();
                    }
                    // 开始库存还原
                    $productSearchModel->number += $shoporder->number;
                    if (!$productSearchModel->save()) {
                        // 回滚
                        $this->db->rollback();
                        // 如果写入失败，则过一会再处理，先报错
                        $logger->notice('Orderdetail save failed, Waiting for retry...' . PHP_EOL);
                        // 等待10秒后重新放入队列
                        $job->release(100, 10);
                    }
                }
                // 库存还原提示
                $logger->notice('Stock reduction success! Great! ' . PHP_EOL);
            }

            // 事务提交
            $this->db->commit();
            // 至此，才算真正的处理完毕
            // 处理成功
            $logger->notice('Success Checkorder ' . $jobInfo . ', Great! ' . PHP_EOL);
            $job->delete();
            $logger->notice('Success Checkorder Job ' . $job_id . '. Deleting.' . PHP_EOL . PHP_EOL);
        }
    }
}