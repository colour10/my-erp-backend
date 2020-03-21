<?php

namespace Asa\Erp;

/**
 * 对账单表
 * Class TbBill
 * @package Asa\Erp
 */
class TbBill extends BaseModel
{
    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_bill');
    }
}
