<?php

namespace Asa\Erp;

/**
 * 关系单位信息，供货商表
 *
 * Class TbSupplier
 * @package Asa\Erp
 */
class TbSupplier extends BaseModel
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
    public $suppliername;

    /**
     *
     * @var string
     */
    public $englishname;

    /**
     *
     * @var string
     */
    public $address;

    /**
     *
     * @var string
     */
    public $phone;

    /**
     *
     * @var string
     */
    public $zipcode;

    /**
     *
     * @var string
     */
    public $email;

    /**
     *
     * @var string
     */
    public $countrycity;

    /**
     *
     * @var string
     */
    public $suppliercode;

    /**
     *
     * @var string
     */
    public $fax;

    /**
     *
     * @var string
     */
    public $suppliertype;

    /**
     *
     * @var string
     */
    public $memo;

    /**
     *
     * @var string
     */
    public $nickname;

    /**
     *
     * @var string
     */
    public $website;

    /**
     *
     * @var string
     */
    public $createtime;

    /**
     *
     * @var integer
     */
    public $companyid;

    /**
     *
     * @var string
     */
    public $mobile;

    /**
     *
     * @var string
     */
    public $linkman;

    /**
     *
     * @var integer
     */
    public $customtype;

    /**
     *
     * @var string
     */
    public $englishaddress;

    /**
     * 初始化
     */
    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_supplier');
    }
}
