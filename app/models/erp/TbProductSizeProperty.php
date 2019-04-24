<?php
namespace Asa\Erp;

/**
 * 基础资料，商品尺码描述主表
 */
class TbProductSizeProperty extends BaseModel
{
    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_product_size_property');
    }
}
