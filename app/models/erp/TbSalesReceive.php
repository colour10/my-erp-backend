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
     *
     * @var integer
     */
    public $id;

    /**
     *
     * @var integer
     */
    public $salesid;

    /**
     *
     * @var integer
     */
    public $currency;

    /**
     *
     * @var double
     */
    public $amount;

    /**
     *
     * @var integer
     */
    public $makestaff;

    /**
     *
     * @var string
     */
    public $maketime;

    /**
     *
     * @var integer
     */
    public $confirmstaff;

    /**
     *
     * @var string
     */
    public $confirmtime;

    /**
     *
     * @var string
     */
    public $paymentdate;

    /**
     *
     * @var integer
     */
    public $companyid;

    /**
     *
     * @var integer
     */
    public $status;

    /**
     *
     * @var integer
     */
    public $payment_type;

    /**
     *
     * @var string
     */
    public $memo;

    /**
     *
     * @var integer
     */
    public $billno;

    /**
     *
     * @var integer
     */
    public $payment_way;

    /**
     *
     * @var integer
     */
    public $billid;

    /**
     *
     * @var integer
     */
    public $paymentwayid;

    /**
     * 初始化
     */
    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_sales_receive');

        // 收款信息-销售单，一对多反向
        $this->belongsTo(
            'salesid',
            TbSales::class,
            'id',
            [
                'alias' => 'sales',
            ]
        );
    }
}
