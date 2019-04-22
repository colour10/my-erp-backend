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

    /**
     * 取整，1=个位；2=十位；3=不取整
     * @param  [type] $value [description]
     * @return [type]        [description]
     */
    function getPriceValue($value) {
        $result = $value*$this->discount;
        if($this->filter==1) {
            //echo $result.'='.$this->myRound($result);
            return $this->myRound($result);
        }
        elseif($this->filter==2) {
            //echo $result.'='.$this->myRound($result)."==".$this->filter."|";
            return $this->myRound(floor($result/10))*10;
        }
        else {
            return $result;
        }
    }

    /**
     * 个位取整
     * @param  [type] $value [description]
     * @return [type]        [description]
     */
    private function myRound($value) {
        $result = floor($value);
        $num = $result%10;
        if($num>=8) {
            return $result +10-$num;
        }
        elseif($num<2) {
            return $result-$num;
        }
        else {
            return $result-$num+5;
        }
    }
}
