<?php

namespace Asa\Erp;

/**
 * 订单付款信息表
 * Class TbOrderPayment
 * @package Asa\Erp
 */
class TbOrderPayment extends BaseModel
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
    public $shippingid;

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

    // 添加枚举
    // 付款状态
    // 未付款
    const STATUS_UNPAID = 0;
    // 已付款
    const STATUS_PAID = 1;

    // 付款类型
    // 定金
    const TYPE_DEPOSIT = 1;
    // 货款
    const TYPE_GOODS = 2;

    /**
     * 初始化
     */
    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_order_payment');
    }
}
