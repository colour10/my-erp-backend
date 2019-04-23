<?php
namespace Asa\Erp;

use Phalcon\Validation;
use Phalcon\Mvc\Model\Relation;
use Phalcon\Validation\Validator\Uniqueness;
use Phalcon\Validation\Validator\PresenceOf;

/**
 * 价格定义表
 */
class TbPrice extends BaseModel
{
    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_price');
    }

    function toArrayPipe() {    
        return [
            "id" => $this->id,
            "name"=>$this->getName()
        ];
    }

    function getName() {
        $di = $this->getDI();

        $country = TbCountry::fetchById($this->countryid);
        if($country==false) {
            throw new Exception("/1001/国家地区不存在/");
        }

        $lang = $di->get("language")->lang;

        return sprintf("%s-%s",$country['name_'.$lang], $di->get("staticReader")->get("pricetype", $this->pricetype));
    }

    function getPriceSetting($brandid, $brandgroupid, $brandgroupchildid, $ageseasonids, $seriesid) {
        $companyid = $this->getDI()->get("currentCompany");

        $ageseasonids = preg_match("#^\d+$#", $ageseasonids) ? ($ageseasonids) : explode(",", $ageseasonids);

        $array = [
            ['priceid', $this->id],
            ['brandid', (int)$brandid],
            ['brandgroupid', (int)$brandgroupid],
            ['brandgroupchildid', (int)$brandgroupchildid],
            ['ageseasonid', $ageseasonids],
            ['seriesid', (int)$seriesid]
        ];

        do {
            $condition = [
                sprintf("companyid=%d", $companyid)
            ];
            foreach($array as $row) {
                if(is_array($row[1])) {
                    $condition[] = $this->getCondition($row[0], $row[1]);
                }
                else {
                    $condition[] = sprintf("%s=%d", $row[0], $row[1]);
                }                
            } 

            $priceSetting = TbPriceSetting::findFirst(
                implode(' and ', $condition)
            );
            //echo implode(' and ', $condition)."+++++\n";
            if($priceSetting!=false) {
                
                return $priceSetting;
            }

            for($i=count($array)-1;$i>=0;$i--) {
                if($array[$i][1]!=0) {
                    $array[$i][1] = 0;
                    break;
                }
            }
        } while($array[0][1]!=0);

        //没有设置价格折扣信息。
        return false;
    }

    private function getCondition($name, $ids) {
        $array = [];
        foreach($ids as $id) {
            $array[] = sprintf("%s=%d", $name, $id);
        }

        return '('.implode(' or ', $array).')';
    }

    public function validation()
    {
        $validation = new Validation;

        $validation->add('countryid', $this->getValidatorFactory()->presenceOf('guojiadiqu'));
        $validation->add('pricetype', $this->getValidatorFactory()->presenceOf('jiageleixing'));
        $validation->add('currencyid', $this->getValidatorFactory()->presenceOf('bizhong'));

        return $this->validate($validation);
    }
}
