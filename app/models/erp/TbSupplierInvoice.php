<?php

namespace Asa\Erp;

/**
 * 基公司发票管理
 * Class TbSupplierInvoice
 * @package Asa\Erp
 */
class TbSupplierInvoice extends BaseModel
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
    public $telephone;

    /**
     *
     * @var string
     */
    public $bank;

    /**
     *
     * @var string
     */
    public $bank_account;

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
    public $tax_number;

    /**
     * 初始化
     */
    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_supplier_invoice');
    }
}
