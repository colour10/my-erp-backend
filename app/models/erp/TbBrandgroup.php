<?php

namespace Asa\Erp;

use Phalcon\Validation;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\Uniqueness;
use Phalcon\Mvc\Model\Relation;

/**
 * 品类表
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
                'alias' => 'brandgroupchilds',
                'foreignKey' => [
                    // 关联字段存在性验证
                    'action' => Relation::ACTION_RESTRICT,
                    "message"    => $this->getValidateMessage('hasmany-foreign-message', 'child-product-group'),
                ],
            ]
        );
    }

    public function getRules() {
        return [
            'name_cn' => $this->getValidatorFactory()->presenceOfMultiple('pinleimingcheng'),
            'displayindex' => $this->getValidatorFactory()->digit('xuhao') 
        ];
    }
}