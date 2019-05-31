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

    public static function getPriceSetting($brandid, $brandgroupid, $brandgroupchildid, $ageseasonid, $priceid) {
        $di = \Phalcon\DI::getDefault();
        return static::findFirst([
            sprintf(
                "companyid=%d and (brandid=%d or brandid=0) and (ageseasonid=%d or ageseasonid=0) and (brandgroupid=%d or brandgroupid=0) and (brandgroupchildid=%d or brandgroupchildid=0) and (priceid=%d or priceid=0)", 
                $di->get("currentCompany"),
                $brandid,
                $ageseasonid,
                $brandgroupid,
                $brandgroupchildid,
                $priceid
            ),
            "order" => "id desc"
        ]);
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
