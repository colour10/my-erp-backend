<?php

namespace Asa\Erp;

/**
 * 销售单收款信息表
 * Class TbSalesReceive
 * @package Asa\Erp
 */
class TbSalesReceive extends BaseModel
{
    /**
     * 初始化
     */
    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_sales_receive');

        $this->belongsTo(
            'salesid',
            '\Asa\Erp\TbSales',
            'id',
            [
                'alias' => 'sales',
            ]
        );
    }
}