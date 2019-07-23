<?php

namespace Asa\Erp;
use Phalcon\Mvc\Model\Relation;

/**
 * 商品尺码信息
 */
class TbSizetop extends BaseModel
{
    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_sizetop');

        // 尺码组-尺码详情，一对多
        $this->hasMany(
            "id",
            "\Asa\Erp\TbSizecontent",
            "topid",
            [
                'alias' => 'sizecontents',
                'foreignKey' => [
                    // 关联字段存在性验证
                    'action' => Relation::ACTION_RESTRICT,
                    "message"    => "/1003/尺码组已经使用，不能删除/",
                ],
            ]
        );

        $this->hasMany(
            "id",
            "\Asa\Erp\TbProduct",
            "sizetopid",
            [
                'alias' => 'products',
                'foreignKey' => [
                    // 关联字段存在性验证
                    'action' => Relation::ACTION_RESTRICT,
                    "message"    => "/1003/尺码组已经使用，不能删除/"
                ],
            ]
        );
    }

    public function getRules() {
        $factory = $this->getValidatorFactory();
        return [
            'name_cn' => $factory->presenceOfMultiple('mingcheng'),
            'code' => [$factory->presenceOf('bianhao'), $factory->uniqueness('bianhao')]
        ];
    }
}
