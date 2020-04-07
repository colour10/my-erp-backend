<?php

namespace Asa\Erp;

use Phalcon\Mvc\Model\Relation;

/**
 * 基础资料，ASA颜色模板表
 * Class TbColortemplate
 * @package Asa\Erp
 */
class TbColortemplate extends BaseModel
{
    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_colortemplate');

        // 颜色-产品，一对多
        $this->hasMany(
            "id",
            "\Asa\Erp\TbProduct",
            "brandcolor",
            [
                'alias'      => 'products',
                'foreignKey' => [
                    // 关联字段存在性验证
                    'action'  => Relation::ACTION_RESTRICT,
                    "message" => "/1003/色系已经使用，不能删除/",
                ],
            ]
        );

        // 颜色-销售类型，一对多
        $this->hasMany(
            "id",
            "\Asa\Erp\TbSaleType",
            "colortemplateid",
            [
                'alias'      => 'saleTypes',
                'foreignKey' => [
                    // 关联字段存在性验证
                    'action'  => Relation::ACTION_RESTRICT,
                    "message" => "/1003/色系已经使用，不能删除/",
                ],
            ]
        );

        // 颜色-色系，一对多反向
        $this->belongsTo(
            'color_system_id',
            '\Asa\Erp\TbColorSystem',
            'id',
            [
                'alias' => 'colorsystem',
            ]
        );
    }
}
