<?php

namespace Asa\Erp;
/**
 * 发货单明细表
 */
class TbConfirmorderdetails extends BaseModel
{
    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_confirmorderdetails');

        // 发货单详情-发货单主表，一对多反向
        $this->belongsTo(
            'confirmorderid',
            '\Asa\Erp\TbConfirmorder',
            'id',
            [
                'alias' => 'confirmorder',
            ]
        );
        // 发货单详情-订单详情表，一对多反向
        $this->belongsTo(
            'orderdetailsid',
            '\Asa\Erp\TbOrderdetails',
            'id',
            [
                'alias' => 'orderdetails',
            ]
        );
    }
}