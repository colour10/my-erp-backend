<?php

namespace Asa\Erp;

use Phalcon\Validation;
use Phalcon\Mvc\Model\Relation;
use Phalcon\Validation\Validator\Uniqueness;
use Phalcon\Validation\Validator\PresenceOf;

/**
 * 
 */
class TbPriceSetting extends BaseModel
{
    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_price_setting');
    }

    public static function getPriceSetting($brandid, $ageseasonid, $producttypeid, $brandgroupchildid, $priceid) {
        $di = \Phalcon\DI::getDefault();

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
            "order" => "brandgroupchildid desc,producttypeid desc"
        ]);
    }
}
