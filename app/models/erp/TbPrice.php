<?php
namespace Asa\Erp;
use Phalcon\Mvc\Model\Relation;

/**
 * 价格定义表
 */
class TbPrice extends BaseModel
{
    private static $box;

    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_price');

        $this->hasMany(
            "id",
            "\Asa\Erp\TbPriceSetting",
            "priceid",
            [
                'alias' => 'prices',
                'foreignKey' => [
                    // 关联字段存在性验证
                    'action' => Relation::ACTION_RESTRICT,
                    "message"    => "/1003/价格已经使用，不能删除/"
                ],
            ]
        );
    }

    public static function getInstance($id) {
        if(!isset(self::$box[$id])) {
            self::$box[$id] = self::findFirstById($id);
        }

        return self::$box[$id];
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

    /**
     * 取整，1=个位；2=十位；3=不取整
     * @param  [type] $value [description]
     * @return [type]        [description]
     */
    function getPriceValue($value) {
        if($this->filter==1) {
            //echo $result.'='.$this->myRound($result);
            return $this->myRound($value);
        }
        elseif($this->filter==2) {
            //echo $result.'='.$this->myRound($result)."==".$this->filter."|";
            return $this->myRound(floor($value/10))*10;
        }
        else {
            return round($value,0);
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
