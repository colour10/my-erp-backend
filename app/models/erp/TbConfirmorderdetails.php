<?php

namespace Asa\Erp;

/**
 * 发货单明细表
 */
class TbConfirmorderdetails extends BaseModel
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
    public $confirmorderid;

    /**
     *
     * @var integer
     */
    public $orderdetailsid;

    /**
     *
     * @var integer
     */
    public $number;

    /**
     *
     * @var double
     */
    public $price;

    /**
     *
     * @var integer
     */
    public $actualnumber;

    /**
     *
     * @var integer
     */
    public $companyid;

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
