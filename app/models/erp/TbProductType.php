<?php

namespace Asa\Erp;

/**
 * 商品属性表
 */
class TbProductType extends BaseModel
{
    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_product_type');
    }
}
