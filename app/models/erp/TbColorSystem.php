<?php

namespace Asa\Erp;

use Phalcon\Mvc\Model\Relation;

/**
 * 基础资料，颜色色系表
 *
 * Class TbColorSystem
 * @package Asa\Erp
 * @property int $id 主键id
 * @property string $title 名称
 * @property-read TbColortemplate $colors 颜色列表
 */
class TbColorSystem extends BaseModel
{
    /**
     * 初始化
     */
    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_color_system');

        // 色系-颜色表，一对多
        $this->hasMany(
            "id",
            TbColortemplate::class,
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
