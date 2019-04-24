<?php
namespace Asa\Erp;

/**
 * 库存日志表
 */
class TbProductstockLog extends BaseModel
{
    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_productstock_log');
    }
}
