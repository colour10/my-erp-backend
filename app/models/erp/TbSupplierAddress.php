<?php

namespace Asa\Erp;

/**
 * 收货人信息
 *
 * Class TbSupplierAddress
 * @package Asa\Erp
 */
class TbSupplierAddress extends BaseModel
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
    public $phone;

    /**
     *
     * @var integer
     */
    public $supplierid;

    /**
     *
     * @var string
     */
    public $zipcode;

    /**
     *
     * @var integer
     */
    public $countryid;

    /**
     *
     * @var string
     */
    public $province;

    /**
     *
     * @var string
     */
    public $city;

    /**
     * 初始化
     */
    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_supplier_address');
    }
}
