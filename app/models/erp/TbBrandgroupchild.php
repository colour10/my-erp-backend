<?php

namespace Asa\Erp;

use Phalcon\Validation;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\Uniqueness;
use Phalcon\Mvc\Model\Relation;

/**
 * 子子品类
 */
class TbBrandgroupchild extends BaseModel
{
    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_brandgroupchild');

        // 子品类-品类，一对多反向
        $this->belongsTo(
            'brandgroupid',
            '\Asa\Erp\TbBrandgroup',
            'id',
            [
                'alias' => 'brandgroup'
            ]
        );

        // 子品类-商品，一对多
        $this->hasMany(
            "id",
            "\Asa\Erp\TbProduct",
            "childbrand",
            [
                'alias' => 'products',
                'foreignKey' => [
                    // 关联字段存在性验证
                    'action' => Relation::ACTION_RESTRICT,
                    "message"    => "/1003/子类已经在商品信息中使用/",
                ],
            ]
        );

        // 子品类-商品，一对多
        $this->hasMany(
            "id",
            "\Asa\Erp\TbBrandgroupchildProperty",
            "brandgroupchildid",
            [
                'alias' => 'brandgroupchildProperties',
                'foreignKey' => [
                    // 关联字段存在性验证
                    'action' => Relation::ACTION_RESTRICT,
                    "message"    => "/1003/子类已经设置了属性/",
                ],
            ]
        );
    }

    public function getRules() {
        return [
            'name_cn' => $this->getValidatorFactory()->presenceOfMultiple('zileimingcheng'),
            'brandgroupid' => $this->getValidatorFactory()->tableid('pinlei'),
            'displayindex' => $this->getValidatorFactory()->digit('xuhao') 
        ];
    }
}