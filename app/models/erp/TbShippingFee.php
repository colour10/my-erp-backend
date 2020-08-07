<?php

namespace Asa\Erp;

/**
 * 费用表
 */
class TbShippingFee extends BaseModel
{
    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_shipping_fee');

        $this->belongsTo(
            'feenameid',
            TbFeename::class,
            'id',
            [
                'alias' => 'feename',
            ]
        );
    }
}
