<?php

namespace Asa\Erp;

/*
 * 商品材质表
 */

class TbProductMaterial extends BaseModel
{
    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_product_material');
    }
}
