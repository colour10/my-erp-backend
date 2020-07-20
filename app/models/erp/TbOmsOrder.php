<?php

namespace Asa\Erp;

/**
 * 来自 oms 的订单表
 */
class TbOmsOrder extends BaseModel
{
    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_oms_order');
    }
}
