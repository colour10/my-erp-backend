<?php

namespace Asa\Erp;

/**
 * 基础资料，最后一次修改产品品牌颜色的统计
 */
class TbProductLastmodify extends BaseModel
{
    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_product_lastmodify');
    }
}
