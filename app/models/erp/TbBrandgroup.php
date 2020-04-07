<?php

namespace Asa\Erp;

use Phalcon\Mvc\Model\Relation;

/**
 * 基础资料：品类表
 * Class TbBrandgroup
 * @package Asa\Erp
 */
class TbBrandgroup extends BaseModel
{
    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_brandgroup');

        // 品类-子品类，一对多
        $this->hasMany(
            "id",
            "\Asa\Erp\TbBrandgroupchild",
            "brandgroupid",
            [
                'alias'      => 'brandgroupchilds',
                'foreignKey' => [
                    // 关联字段存在性验证
                    'action'  => Relation::ACTION_RESTRICT,
                    "message" => "/1003/品类数据已经使用，不允许删除/",
                ],
            ]
        );
    }

    public function getRules()
    {
        return [
            'name_cn'      => $this->getValidatorFactory()->presenceOfMultiple('pinleimingcheng'),
            'displayindex' => $this->getValidatorFactory()->digit('xuhao'),
        ];
    }
}
