<?php

namespace Asa\Erp;

/**
 * 供应商-公司账号信息表
 *
 * Class TbSupplierBank
 * @package Asa\Erp
 */
class TbSupplierBank extends BaseModel
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
    public $supplierid;

    /**
     *
     * @var integer
     */
    public $companyid;

    /**
     *
     * @var string
     */
    public $name;

    /**
     *
     * @var string
     */
    public $address;

    /**
     *
     * @var string
     */
    public $bank_name;

    /**
     *
     * @var string
     */
    public $bank_address;

    /**
     *
     * @var string
     */
    public $bank_depart;

    /**
     *
     * @var string
     */
    public $account;

    /**
     *
     * @var string
     */
    public $bank_code;

    /**
     *
     * @var integer
     */
    public $currency;

    /**
     * 初始化
     */
    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_supplier_bank');
    }
}
