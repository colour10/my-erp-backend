<?php

/**
 *
 * Class ReplaceTask
 */
class TestTask extends \Phalcon\CLI\Task
{
    /**
     * 生成逻辑
     * companyid、brandid、wordcode_3唯一
     */
    public function mainAction()
    {
        \Asa\Erp\Util::sendStockChange(337,2);
    }
}