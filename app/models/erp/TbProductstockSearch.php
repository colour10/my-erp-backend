<?php

namespace Asa\Erp;

/**
 * 商品库存检索表
 * Class TbProductstockSearch
 * @package Asa\Erp
 */
class TbProductstockSearch extends BaseModel
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
    public $productid;

    /**
     *
     * @var integer
     */
    public $warehouseid;

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
     * @var string
     */
    public $productmemoids;

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
    public $sizecontentids;

    /**
     *
     * @var string
     */
    public $sizecontent_data;

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
     * 初始化
     */
    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_productstock_search');
    }

    function getDataList()
    {
        $result = [];
        $array = explode(';', $this->sizecontent_data);
        foreach ($array as $row) {
            $temp = explode(',', $row);
            $result[] = [
                "sizecontentid"  => $temp[0],
                "number"         => $temp[1],
                "reserve_number" => $temp[2],
                "sales_number"   => $temp[3],
            ];
        }

        return $result;
    }
}
