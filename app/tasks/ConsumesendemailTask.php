<?php

use Phalcon\Cli\Task;
use Phalcon\Queue\Beanstalk;
use Asa\Erp\Util;
use Phalcon\Logger\Adapter\File as FileAdapter;

/**
 * 发送注册邮件
 * Class ConsumesendemailTask
 */
class ConsumesendemailTask extends Task
{
    /**
     * 主方法
     */
    public function mainAction()
    {
        // 添加插件自动加载
        require_once(APP_PATH . "/vendor/autoload.php");

        // 连接Beanstalk
        $queue = new Beanstalk([
            'host' => 'localhost',
            'port' => 11300,
        ]);

        // choose方法指定tube
        $queue->watch("my_sendemail_tube");

        // 初始化日志地址
        $root_path = dirname(dirname(__FILE__));
        $folder = $root_path . '/cache/logs/';
        if (!file_exists($folder)) {
            Util::Directory($folder);
        }
        // 初始化文件地址
        $logger = new FileAdapter($folder . "queue.log");

        // 循环遍历
        while (true) {
            // 开启事务
            $logger->begin();
            // 起始提示，防止日志过大，暂时注释
            // $logger->notice('Waiting for a sendmail job... CTRL+C to abort.' . PHP_EOL . PHP_EOL);
            // 获取任务
            $job = $queue->reserve();
            // 如果有任务，则进行处理
            if ($job) {
                // 存在则继续处理
                $job_id = $job->getId();
                // 防止日志过大，暂时注释
                // $logger->notice('Processing sendmail job ' . $job_id . PHP_EOL);
                // 获取任务详情
                // 开始发送邮件
                $jobInfo = $job->getBody();
                // 转成数组
                // 提取出三个必要参数$email、$notice、$content
                list($email, $notice, $content) = json_decode($jobInfo, true);
                if (Util::sendEmail($email, $notice, $content)) {
                    $logger->notice('Success Sendmail to ' . $email . '，Great! ' . PHP_EOL);
                    $job->delete();
                    $logger->notice('Success Sendmail Job ' . $job_id . '. Deleting.' . PHP_EOL);
                } else {
                    // 说明邮件没有发送成功，10秒后将重新放入队列进行发送，防止日志过大，暂时注释
                    // $logger->notice('Failed Sendmail Job, Waiting for retry...' . PHP_EOL);
                    // 重新放回队列，10秒后重新发送
                    $job->release(100, 10);
                }
            }
            // 保存消息到文件中
            $logger->commit();
        }

    }

}
