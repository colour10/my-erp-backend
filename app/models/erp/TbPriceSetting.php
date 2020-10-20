<?php

namespace Asa\Erp;

use Phalcon\Di;
use Phalcon\Mvc\Model;

/**
 * 价格设置表
 *
 * Class TbPriceSetting
 * @package Asa\Erp
 * @property int $id 主键id
 * @property int|null $companyid 公司id
 * @property int|null $brandid 品牌id
 * @property int|null $brandgroupchildid 子品类id
 * @property int|null $ageseasonid 年代季节id
 * @property int|null $producttypeid 商品属性
 * @property float|null $discount 系数
 * @property int|null $priceid 价格id
 */
class TbPriceSetting extends BaseModel
{
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
