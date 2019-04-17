<?php

namespace Asa\Erp;

use Phalcon\Validation;
use Phalcon\Mvc\Model\Relation;
use Phalcon\Validation\Validator\Uniqueness;
use Phalcon\Validation\Validator\PresenceOf;

/**
 * 
 */
class TbPrice extends BaseModel
{
    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_price');
    }

    function getDiscount($brandid, $brandgroupid, $brandgroupchildid, $ageseasonid, $seriesid) {
        $result = static::find(
            sprintf("companyid=%d", $this->getDI()->get("currentCompany"))
        );

        $array = [];
        foreach($result as $row) {
            $key = sprintf(
                "%d.%d.%d.%d.%d", $row->brandid, $row->brandgroupid, $row->brandgroupchildid, $row->ageseasonid, $row->seriesid
            );
            $array[$key] = $row->discount;
        }

        $keys = [$brandid, $brandgroupid, $brandgroupchildid, $ageseasonid, $seriesid];
        for($i=4; $i>0; $i--) {
            $key = implode('.', $keys);
            if(isset($array[$key])) {
                return $array[$key];
            }
            else {
                $keys[$i] = 0;
            }
        }

        throw new \Exception("/1100/没有设置倍率信息/");
    }
}
