<?php

use Asa\Erp\Util;

/**
 * 发送注册邮件
 * Class ConsumesendemailTask
 */
class ConsumesendemailTask extends CommonTask
{
    // 管道名称
    public function getQueueName()
    {
        return 'my_sendemail_tube';
    }

    // 队列处理逻辑
    public function do($logger, $job)
    {
        // 提取出三个必要参数$email、$notice、$content
        list($email, $notice, $content) = json_decode($job->getBody(), true);
        if (Util::sendEmail($email, $notice, $content)) {
            $logger->notice('Success Sendmail to ' . $email . '，Great! ' . PHP_EOL);
            $job->delete();
            $logger->notice('Success Sendmail Job ' . $job->getId() . '. Deleting.' . PHP_EOL);
        } else {
            // 重新放回队列，60秒后重新发送
            $job->release(100, 60);
        }
    }

}
