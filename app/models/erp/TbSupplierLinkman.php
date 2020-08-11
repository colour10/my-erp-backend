<?php

namespace Asa\Erp;

/**
 * 供应商，联系人信息
 * Class TbSupplierLinkman
 * @package Asa\Erp
 */
class TbSupplierLinkman extends BaseModel
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
     * @var string
     */
    public $name;

    /**
     *
     * @var string
     */
    public $phone;

    /**
     *
     * @var string
     */
    public $email;

    /**
     *
     * @var integer
     */
    public $gender;

    /**
     *
     * @var string
     */
    public $duty;

    /**
     *
     * @var string
     */
    public $fax;

    /**
     *
     * @var string
     */
    public $department;

    /**
     *
     * @var string
     */
    public $address;

    /**
     *
     * @var string
     */
    public $zipcode;

    /**
     *
     * @var string
     */
    public $mobile;

    /**
     * 初始化
     */
    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_supplier_linkman');
    }
}
