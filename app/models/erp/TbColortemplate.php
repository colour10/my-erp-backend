<?php

namespace Asa\Erp;

use Phalcon\Mvc\Model\Relation;


/**
 * 基础资料，ASA颜色模板表
 */
class TbColortemplate extends BaseModel
{
    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_colortemplate');

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
    }
}
