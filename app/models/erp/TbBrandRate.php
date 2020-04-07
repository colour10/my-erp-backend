<?php

namespace Asa\Erp;

/**
 * 品牌倍率表
 * Class TbBrandRate
 * @package Asa\Erp
 */
class TbBrandRate extends BaseModel
{
    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_brand_rate');
    }
}
