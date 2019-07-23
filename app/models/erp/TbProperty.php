<?php
namespace Asa\Erp;
use Phalcon\Mvc\Model\Relation;

/**
 * 属性定义表
 */
class TbProperty extends BaseModel
{
    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_property');

        $this->hasMany(
            "id",
            "\Asa\Erp\TbBrandgroupchildProperty",
            "propertyid",
            [
                'alias' => 'brandgroupchildproperties',
                'foreignKey' => [
                    // 关联字段存在性验证
                    'action' => Relation::ACTION_RESTRICT,
                    "message"    => "/1003/属性已经使用，不能删除/"
                ],
            ]
        );
    }
}
