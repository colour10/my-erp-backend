<?php
namespace Asa\Erp;

/**
 * 商品库存检索表
 */
class TbProductstockSummary extends BaseModel
{
    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_productstock_summary');
    }
}
