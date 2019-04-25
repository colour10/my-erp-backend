<?php
namespace Asa\Erp;

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

    public function getRules() {
        $factory = $this->getValidatorFactory();
        return [
            'countryid' => [$factory->presenceOf('guojiadiqu'), $factory->digit('guojiadiqu')],
            'pricetype' => [$factory->presenceOf('jiageleixing'), $factory->digit('jiageleixing')],
            'currencyid' => [$factory->presenceOf('bizhong'), $factory->digit('bizhong')]
        ];
    }
}
