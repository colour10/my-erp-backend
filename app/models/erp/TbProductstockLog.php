<?php

namespace Asa\Erp;

/**
 * 库存日志表
 * Class TbProductstockLog
 * @package Asa\Erp
 */
class TbProductstockLog extends BaseModel
{
    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_productstock_log');
    }
}
