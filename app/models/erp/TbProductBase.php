<?php

namespace Asa\Erp;

/**
 * 商品国际码库
 *
 * Class TbProductBase
 * @package Asa\Erp
 * @property int $id 主键id
 * @property int|null $productid 商品id
 * @property string|null $wordcode 国际码
 * @property-read TbProduct|null $product 商品
 */
class TbProductBase extends BaseModel
{
    /**
     * 初始化
     */
    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_product_base');

        // 商品国际码-商品表，一对多反向
        $this->belongsTo(
            'productid',
            TbProduct::class,
            'id',
            [
                'alias' => 'product',
            ]
        );
    }
}
