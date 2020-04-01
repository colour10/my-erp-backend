<?php

namespace Asa\Erp;

use Phalcon\Mvc\Model\Relation;

/**
 * 基础资料，颜色色系表
 */
class TbColorSystem extends BaseModel
{
    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_color_system');

        // 色系-颜色表，一对多
        $this->hasMany(
            "id",
            "\Asa\Erp\TbColortemplate",
            "color_system_id",
            [
                'alias'      => 'colors',
                'foreignKey' => [
                    // 关联字段存在性验证
                    'action'  => Relation::ACTION_RESTRICT,
                    "message" => "/10003/色系已经使用，不能删除/",
                ],
            ]
        );
    }
}
