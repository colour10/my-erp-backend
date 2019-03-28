<?php

namespace Asa\Erp;

use Phalcon\Validation;
use Phalcon\Validation\Validator\Uniqueness;
use Phalcon\Mvc\Model\Relation;

/**
 * 商品表
 */
class TbProduct extends BaseModel
{
    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_product');

        // 商品-子品类，一对多反向
        $this->belongsTo(
            'childbrand',
            '\Asa\Erp\zl_childproductgroup',
            'id',
            [
                'alias' => 'childproductgroup',
                'foreignKey' => [
                    // 关联字段禁止自动删除
                    'action' => Relation::ACTION_RESTRICT,
                    "message" => $this->getValidateMessage('notexist', 'childproductgroup-list'),
                ],
            ]
        );
    }

    public function validation() {
        $validator = new Validation();

//        $validator->add(
//            "age",
//            new Between(
//                [
//                    "minimum" => 18,
//                    "maximum" => 60,
//                    "message" => "年龄必须是18~60岁",
//                ]
//            )
//        );
//
//        $validator->add(
//            'name',
//            new Uniqueness(
//                [
//                    'message' => '姓名不能重复',
//                ]
//            )
//        );

        return $this->validate($validator);
    }
}
