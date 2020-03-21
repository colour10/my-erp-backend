<?php

namespace Asa\Erp;

/**
 * 商品国际码库
 * Class TbProductBase
 * @package Asa\Erp
 */
class TbProductBase extends BaseModel
{
    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_product_base');

        $this->belongsTo(
            'productid',
            '\Asa\Erp\TbProduct',
            'id',
            [
                'alias' => 'product',
            ]
        );
    }
}
