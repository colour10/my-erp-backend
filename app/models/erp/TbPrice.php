<?php

namespace Asa\Erp;

use Phalcon\Mvc\Model\Relation;

/**
 * 价格定义表
 *
 * Class TbPrice
 * @package Asa\Erp
 */
class TbPrice extends BaseModel
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
    public $countryid;

    /**
     *
     * @var integer
     */
    public $pricetype;

    /**
     *
     * @var integer
     */
    public $currencyid;

    /**
     *
     * @var integer
     */
    public $companyid;

    /**
     *
     * @var string
     */
    public $name;

    /**
     *
     * @var integer
     */
    public $displayindex;

    /**
     *
     * @var integer
     */
    public $filter;

    // 单例模式
    private static $box;

    /**
     * 初始化
     */
    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_price');

        $this->hasMany(
            "id",
            TbPriceSetting::class,
            "priceid",
            [
                'alias'      => 'prices',
                'foreignKey' => [
                    // 关联字段存在性验证
                    'action'  => Relation::ACTION_RESTRICT,
                    "message" => "/1003/价格已经使用，不能删除/",
                ],
            ]
        );
    }

    /**
     * 返回单例
     *
     * @param $id
     * @return mixed
     */
    public static function getInstance($id)
    {
        if (!isset(self::$box[$id])) {
            self::$box[$id] = self::findFirstById($id);
        }

        return self::$box[$id];
    }

    /**
     * 搜索条件
     *
     * @param $name
     * @param $ids
     * @return string
     */
    private function getCondition($name, $ids)
    {
        $array = [];
        foreach ($ids as $id) {
            $array[] = sprintf("%s=%d", $name, $id);
        }

        return '(' . implode(' or ', $array) . ')';
    }

    /**
     * 验证规则
     *
     * @return array
     */
    public function getRules()
    {
        $factory = $this->getValidatorFactory();
        return [
            'countryid'  => [$factory->presenceOf('guojiadiqu'), $factory->digit('guojiadiqu')],
            'pricetype'  => [$factory->presenceOf('jiageleixing'), $factory->digit('jiageleixing')],
            'currencyid' => [$factory->presenceOf('bizhong'), $factory->digit('bizhong')],
        ];
    }

    /**
     * 取整，1=个位；2=十位；3=不取整
     * @param  [type] $value [description]
     * @return [type]        [description]
     */
    function getPriceValue($value)
    {
        if ($this->filter == 1) {
            //echo $result.'='.$this->myRound($result);
            return $this->myRound($value);
        } elseif ($this->filter == 2) {
            //echo $result.'='.$this->myRound($result)."==".$this->filter."|";
            return $this->myRound(floor($value / 10)) * 10;
        } else {
            return round($value, 0);
        }
    }

    /**
     * 个位取整
     * @param  [type] $value [description]
     * @return [type]        [description]
     */
    private function myRound($value)
    {
        $result = floor($value);
        $num = $result % 10;
        if ($num >= 8) {
            return $result + 10 - $num;
        } elseif ($num < 2) {
            return $result - $num;
        } else {
            return $result - $num + 5;
        }
    }
}
