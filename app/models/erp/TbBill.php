<?php
namespace Asa\Erp;

/**
 * 对账单
 */
class TbBill extends BaseModel
{
    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_bill');
    }
}
