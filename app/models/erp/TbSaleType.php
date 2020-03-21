<?php

namespace Asa\Erp;

use Phalcon\Mvc\Model\Relation;

/**
 * 销售属性表
 */
class TbSaleType extends BaseModel
{
    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_sale_type');

        $this->hasMany(
            "id",
            "\Asa\Erp\TbProduct",
            "saletypeid",
            [
                'alias'      => 'products',
                'foreignKey' => [
                    // 关联字段存在性验证
                    'action'  => Relation::ACTION_RESTRICT,
                    "message" => "/1003/销售属性已经使用，不能删除/",
                ],
            ]
        );
    }
}
