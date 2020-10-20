<?php

namespace Asa\Erp;

/**
 * 发货单明细表
 *
 * Class TbConfirmorderdetails
 * @package Asa\Erp
 * @property int $id 主键id
 * @property int|null $confirmorderid 发货单id
 * @property int|null $orderdetailsid 订单明细id
 * @property int|null $number 发货数量
 * @property float|null $price 单价
 * @property int|null $actualnumber 到货数量
 * @property int|null $companyid 公司id
 * @property-read TbConfirmorder|null $confirmorder 发货单
 * @property-read TbOrderdetails|null $orderdetails 订单详情
 */
class TbConfirmorderdetails extends BaseModel
{
    /**
     * 初始化
     */
    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_confirmorderdetails');

        // 发货单详情-发货单主表，一对多反向
        $this->belongsTo(
            'confirmorderid',
            TbConfirmorder::class,
            'id',
            [
                'alias' => 'confirmorder',
            ]
        );
        // 发货单详情-订单详情表，一对多反向
        $this->belongsTo(
            'orderdetailsid',
            TbOrderdetails::class,
            'id',
            [
                'alias' => 'orderdetails',
            ]
        );
    }
}
