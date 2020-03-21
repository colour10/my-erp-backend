<?php

use Asa\Erp\Util;
use Phalcon\Cli\Task;
use Phalcon\Logger\Adapter\File as FileAdapter;
use Phalcon\Queue\Beanstalk;

/**
 * 采用异步处理，抽象类
 * Class CommonTask
 */
abstract class CommonTask extends Task
{
    // 设定当前队列的名称
    abstract function getQueueName();

    /**
     * 主要队列逻辑
     * @param object $logger 日志对象
     * @param object $job 队列对象
     * @return mixed|void
     */
    abstract function do($logger, $job);

    /**
     * 主方法
     */
    public function mainAction()
    {
        // 逻辑
        // 添加插件自动加载
        require_once(APP_PATH . "/vendor/autoload.php");

        // 连接Beanstalk
        $queue = new Beanstalk([
            'host' => 'localhost',
            'port' => 11300,
        ]);

        // 指定管道名称
        $queue->watch($this->getQueueName());

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
            // 获取任务
            $job = $queue->reserve();
            // 如果有任务，则进行处理
            if ($job) {
                // 队列处理逻辑
                $this->do($logger, $job);
            }
            // 保存消息到文件中
            $logger->commit();
        }
    }

}
