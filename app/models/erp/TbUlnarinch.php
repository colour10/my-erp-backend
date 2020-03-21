<?php

namespace Asa\Erp;

use Phalcon\Mvc\Model\Relation;

/**
 * 基础资料，商品尺寸表
 */
class TbUlnarinch extends BaseModel
{
    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_ulnarinch');

        $this->hasMany(
            "id",
            "\Asa\Erp\TbProduct",
            "ulnarinch",
            [
                'alias'      => 'products',
                'foreignKey' => [
                    // 关联字段存在性验证
                    'action'  => Relation::ACTION_RESTRICT,
                    "message" => "/1003/商品尺寸已经使用，不能删除/",
                ],
            ]
        );
    }
}
