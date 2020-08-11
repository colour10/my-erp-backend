<?php

namespace Asa\Erp;

/**
 * 用户价格表
 * Class TbUserPrice
 * @package Asa\Erp
 */
class TbUserPrice extends BaseModel
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
    public $userid;

    /**
     *
     * @var integer
     */
    public $priceid;

    /**
     * 初始化
     */
    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_user_price');

        // 用户价格表-价格表, 一对多反向
        $this->belongsTo(
            'priceid',
            TbPrice::class,
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
