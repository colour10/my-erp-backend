<?php

namespace Asa\Erp;

/**
 * 基公司发票管理
 * Class TbCompanyInvoice
 * @package Asa\Erp
 */
class TbCompanyInvoice extends BaseModel
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
    public $companyid;

    /**
     * 初始化
     */
    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_company_invoice');
    }
}
