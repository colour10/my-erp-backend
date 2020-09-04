<?php

namespace Asa\Erp;

use Phalcon\Mvc\Model\Relation;

/**
 * 公司表
 * Class TbCompany
 * @package Asa\Erp
 */
class TbCompany extends BaseModel
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
     * @var integer
     */
    public $countryid;

    /**
     *
     * @var string
     */
    public $memo;

    /**
     *
     * @var integer
     */
    public $randid;

    /**
     *
     * @var integer
     */
    public $saleportid;

    /**
     *
     * @var integer
     */
    public $currencyid;

    /**
     *
     * @var string
     */
    public $language;

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
    public $fax;

    /**
     *
     * @var string
     */
    public $legal;

    /**
     *
     * @var string
     */
    public $website;

    /**
     *
     * @var string
     */
    public $registeredcapital;

    /**
     *
     * @var string
     */
    public $businesslicense;

    /**
     *
     * @var string
     */
    public $heading;

    /**
     *
     * @var integer
     */
    public $hkgcost;

    /**
     *
     * @var integer
     */
    public $eurcost;

    /**
     *
     * @var integer
     */
    public $chncost;

    /**
     *
     * @var integer
     */
    public $bdacost;

    /**
     *
     * @var integer
     */
    public $oms_saleport;

    /**
     *
     * @var string
     */
    public $oms_warehouseids;

    /**
     * 初始化
     */
    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_company');

        // 公司-国家，一对多反向
        $this->belongsTo(
            'countryid',
            TbCountry::class,
            'id',
            [
                'alias' => 'country',
            ]
        );

        // 公司-部门，一对多
        $this->hasMany(
            "id",
            TbDepartment::class,
            "companyid",
            [
                'alias'      => 'departments',
                'foreignKey' => [
                    // 关联字段存在性验证
                    'action'  => Relation::ACTION_RESTRICT,
                    "message" => "#1003#",
                ],
            ]
        );

        // 公司-商品表，一对多
        $this->hasMany(
            "id",
            TbProduct::class,
            "companyid",
            [
                'alias'      => 'products',
                'foreignKey' => [
                    // 关联字段存在性验证
                    'action'  => Relation::ACTION_RESTRICT,
                    "message" => $this->getValidateMessage('hasmany-foreign-message', 'product'),
                ],
            ]
        );

        // 公司-销售端口，一对多反向
        $this->belongsTo(
            'saleportid',
            TbSaleport::class,
            'id',
            [
                'alias' => 'shopSaleport',
            ]
        );

        // 公司-仓库表，一对多
        $this->hasMany(
            "id",
            TbWarehouse::class,
            "companyid",
            [
                'alias' => 'warehouses',
            ]
        );
    }
}
