<?php

namespace Asa\Erp;

use Phalcon\Di;
use Phalcon\Mvc\Model;

/**
 * 价格设置表
 * Class TbPriceSetting
 * @package Asa\Erp
 */
class TbPriceSetting extends BaseModel
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
    public $brandid;

    /**
     *
     * @var integer
     */
    public $brandgroupchildid;

    /**
     *
     * @var integer
     */
    public $ageseasonid;

    /**
     *
     * @var integer
     */
    public $producttypeid;

    /**
     *
     * @var double
     */
    public $discount;

    /**
     *
     * @var integer
     */
    public $priceid;

    /**
     * 初始化
     */
    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_price_setting');
    }

    /**
     * 取出价格
     *
     * @param $brandid
     * @param $ageseasonid
     * @param $producttypeid
     * @param $brandgroupchildid
     * @param $priceid
     * @return Model
     */
    public static function getPriceSetting($brandid, $ageseasonid, $producttypeid, $brandgroupchildid, $priceid)
    {
        $di = Di::getDefault();

        return static::findFirst([
            sprintf(
                "companyid=%d and brandid=%d and ageseasonid=%d and (producttypeid=%d or producttypeid=0) and (brandgroupchildid=%d or brandgroupchildid=0) and priceid=%d and discount>0",
                $di->get("currentCompany"),
                $brandid,
                $ageseasonid,
                $producttypeid,
                $brandgroupchildid,
                $priceid
            ),
            "order" => "brandgroupchildid desc,producttypeid desc",
        ]);
    }
}
