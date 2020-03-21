<?php

namespace Asa\Erp;

/**
 * 库存快照表
 */
class TbProductstockSnapshot extends BaseModel
{
    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_productstock_snapshot');
    }
}
