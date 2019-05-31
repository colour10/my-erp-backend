<?php
namespace Asa\Erp;
use Phalcon\Mvc\Model\Relation;

/**
 * 价格定义表
 */
class TbPrice extends BaseModel
{
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
