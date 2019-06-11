<?php

use Phalcon\Queue\Beanstalk;

class ConsumeTask extends \Phalcon\CLI\Task
{

    public function mainAction()
    {
        // 连接Beanstalk
        $queue = new Beanstalk([
            'host' => 'localhost',
            'port' => 11300,
        ]);
        // choose方法指定tube
        $queue->watch("my_tube");

        // 循环遍历
        while (true) {
            echo 'Waiting for a job... STRG+C to abort.' . "\n";
            // 获取任务
            $job = $queue->reserve();
            if (!$job) {
                echo 'Invalid job found. Not processing.' . "\n";
            } else {
                $job_id = $job->getId();
                echo 'Processing job ' . $job_id . "\n";
                // 获取任务详情
                $jobInfo = $job->getBody();
                if ($jobInfo) {
                    echo '操作成功' . PHP_EOL;
                    $job->delete();
                    echo 'Success Job ' . $job_id . '. Deleting.' . "\n";
                }
            }
        }
    }

}
