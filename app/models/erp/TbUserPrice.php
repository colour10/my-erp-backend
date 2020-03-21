<?php

namespace Asa\Erp;

/**
 * 用户价格表
 */
class TbUserPrice extends BaseModel
{
    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_user_price');

        $this->belongsTo(
            'priceid',
            '\Asa\Erp\TbPrice',
            'id',
            [
                'alias' => 'price',
            ]
        );
    }

    function toArrayPipe()
    {
        $price = $this->price;

        $result = $this->toArray();
        $result['name'] = $price->name;
        return $result;
    }
}
