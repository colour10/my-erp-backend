<?php

namespace Asa\Erp;

/**
 * 订单明细表
 */
class TbOrderdetails extends BaseModel
{
    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_orderdetails');

        // 订单详情-商品主表，一对多反向
        $this->belongsTo(
            'productid',
            '\Asa\Erp\TbProduct',
            'id',
            [
                'alias' => 'product',
            ]
        );

        // 订单详情-商品尺码表，一对多反向
        $this->belongsTo(
            'sizecontentid',
            '\Asa\Erp\TbSizecontent',
            'id',
            [
                'alias' => 'sizecontent',
            ]
        );

        // 订单详情-商品主表，一对多反向
        $this->belongsTo(
            'orderid',
            '\Asa\Erp\TbOrder',
            'id',
            [
                'alias' => 'order',
            ]
        );
    }
}
