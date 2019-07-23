<?php
namespace Asa\Erp;

/**
 * 品牌订单明细
 */
class TbOrderBrandDetail extends BaseModel
{
    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_order_brand_detail');
    }
}
