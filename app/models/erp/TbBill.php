<?php

namespace Asa\Erp;

/**
 * 对账单表
 * Class TbBill
 * @package Asa\Erp
 */
class TbBill extends BaseModel
{
    /**
     *
     * @var integer
     */
    public $id;

    /**
     *
     * @var string
     */
    public $billno;

    /**
     *
     * @var integer
     */
    public $companyid;

    /**
     *
     * @var string
     */
    public $createtime;

    /**
     *
     * @var integer
     */
    public $createstaff;

    /**
     *
     * @var string
     */
    public $memo;

    /**
     *
     * @var integer
     */
    public $status;

    /**
     *
     * @var string
     */
    public $out_billno;

    /**
     *
     * @var integer
     */
    public $currencyid;

    /**
     *
     * @var double
     */
    public $amount_origin;

    /**
     *
     * @var double
     */
    public $amount;

    /**
     *
     * @var integer
     */
    public $supplierid;

    /**
     *
     * @var integer
     */
    public $invoiceid;

    /**
     *
     * @var integer
     */
    public $billtype;

    // 对账单的三种状态
    // 1、未回款
    const STATUS_NOT_PAYMENT = 1;
    // 2、部分回款
    const STATUS_PART_PAYMENT = 2;
    // 3、已回款
    const STATUS_ALL_PAYMENT = 3;

    /**
     * 初始化
     */
    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_bill');
    }
}
