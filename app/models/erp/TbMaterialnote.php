<?php

namespace Asa\Erp;

use Phalcon\Mvc\Model\Relation;

/**
 * 基础资料，材质备注表
 */
class TbMaterialnote extends BaseModel
{
    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_materialnote');

        $this->hasMany(
            "id",
            "\Asa\Erp\TbProductMaterial",
            "materialnoteid",
            [
                'alias'      => 'productMaterial',
                'foreignKey' => [
                    // 关联字段存在性验证
                    'action'  => Relation::ACTION_RESTRICT,
                    "message" => "/1003/材质备注已经使用，不能删除/",
                ],
            ]
        );
    }
}
