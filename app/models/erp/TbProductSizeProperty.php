<?php

namespace Asa\Erp;

/**
 * 基础资料，商品尺码描述主表
 *
 * Class TbProductSizeProperty
 * @package Asa\Erp
 * @property int $id 主键id
 * @property int|null $productid 商品id
 * @property int|null $sizecontentid 尺码id
 * @property int|null $propertyid 属性id
 * @property string|null $content 内容
 */
class TbProductSizeProperty extends BaseModel
{
    /**
     * 初始化
     */
    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_product_size_property');
    }
}
