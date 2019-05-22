<?php
namespace Asa\Erp;

/**
 * 发货单主表
 */
class TbShipping extends BaseModel
{
    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_shipping');

        // 订单-订单详情，一对多
        $this->hasMany(
            "id",
            "\Asa\Erp\TbShippingDetail",
            "shippingid",
            [
                'alias' => 'shippingDetail'
            ]
        );
    }
}
