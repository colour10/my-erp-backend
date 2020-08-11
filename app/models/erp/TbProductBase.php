<?php

namespace Asa\Erp;

/**
 * 商品国际码库
 * Class TbProductBase
 * @package Asa\Erp
 */
class TbProductBase extends BaseModel
{
    /**
     *
     * @var integer
     */
    public $id;

    /**
     *
     * @var integer
     */
    public $productid;

    /**
     *
     * @var string
     */
    public $wordcode;

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
