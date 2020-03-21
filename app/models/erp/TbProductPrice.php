<?php

namespace Asa\Erp;

/**
 * 商品价格表
 */
class TbProductPrice extends BaseModel
{
    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_product_price');
    }
}
