<?php
namespace Asa\Erp;

/**
 * 品牌倍率表
 */
class TbBrandRate extends BaseModel
{
    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_brand_rate');
    }
}
