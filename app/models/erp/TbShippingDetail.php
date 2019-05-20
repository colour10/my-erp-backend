<?php
namespace Asa\Erp;

/**
 * 发货单明细表
 */
class TbShippingDetail extends BaseModel
{
    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_shipping_detail');
    }
}
