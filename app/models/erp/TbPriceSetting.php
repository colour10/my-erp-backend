<?php

namespace Asa\Erp;

use Phalcon\Di;

/**
 * 价格设置表
 * Class TbPriceSetting
 * @package Asa\Erp
 */
class TbPriceSetting extends BaseModel
{
    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_price_setting');
    }

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
