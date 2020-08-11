<?php

namespace Asa\Erp;

/**
 * 基础资料，商品尺码描述主表
 * Class TbProductSizeProperty
 * @package Asa\Erp
 */
class TbProductSizeProperty extends BaseModel
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
     * @var integer
     */
    public $sizecontentid;

    /**
     *
     * @var integer
     */
    public $propertyid;

    /**
     *
     * @var string
     */
    public $content;

    /**
     * 初始化
     */
    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_product_size_property');
    }
}
