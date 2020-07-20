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
        // 把 post 变量信息按照订单号写到对应的表中，然后分别处理
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
                $m->orderNo = $OrderNo;
                $m->extra = $jobInfo;
                $m->create();
            } else {
                $model->extra = $jobInfo;
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
