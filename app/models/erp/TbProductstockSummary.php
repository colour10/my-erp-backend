<?php

namespace Asa\Erp;

/**
 * 商品库存检索表
 * Class TbProductstockSummary
 * @package Asa\Erp
 */
class TbProductstockSummary extends BaseModel
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
    public $companyid;

    /**
     *
     * @var integer
     */
    public $warehouseid;

    /**
     *
     * @var integer
     */
    public $productid;

    /**
     *
     * @var integer
     */
    public $property;

    /**
     *
     * @var integer
     */
    public $defective_level;

    /**
     *
     * @var integer
     */
    public $number;

    /**
     *
     * @var string
     */
    public $wordcode;

    /**
     *
     * @var string
     */
    public $ageseason;

    /**
     *
     * @var string
     */
    public $countries;

    /**
     *
     * @var integer
     */
    public $brandid;

    /**
     *
     * @var integer
     */
    public $brandgroupid;

    /**
     *
     * @var integer
     */
    public $childbrand;

    /**
     *
     * @var integer
     */
    public $brandcolor;

    /**
     *
     * @var string
     */
    public $ulnarinch;

    /**
     *
     * @var integer
     */
    public $saletypeid;

    /**
     *
     * @var integer
     */
    public $producttypeid;

    /**
     *
     * @var string
     */
    public $gender;

    /**
     *
     * @var integer
     */
    public $spring;

    /**
     *
     * @var integer
     */
    public $summer;

    /**
     *
     * @var integer
     */
    public $fall;

    /**
     *
     * @var integer
     */
    public $winter;

    /**
     *
     * @var integer
     */
    public $series;

    /**
     *
     * @var string
     */
    public $laststoragedate;

    /**
     *
     * @var integer
     */
    public $sizecontentid;

    /**
     *
     * @var integer
     */
    public $reserve_number;

    /**
     *
     * @var integer
     */
    public $sales_number;

    /**
     *
     * @var integer
     */
    public $shipping_number;

    /**
     *
     * @var string
     */
    public $created_at;

    /**
     *
     * @var string
     */
    public $updated_at;

    /**
     * 初始化
     */
    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_productstock_summary');
    }
}
