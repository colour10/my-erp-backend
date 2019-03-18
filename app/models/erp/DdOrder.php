<?php

namespace Asa\Erp;

use Phalcon\Validation;
use Phalcon\Validation\Validator\Between;
use Phalcon\Validation\Validator\Uniqueness;
use Phalcon\Mvc\Model\Relation;

/**
 * 订单主表
 */
class DdOrder extends BaseModel
{
    public function initialize()
    {
        parent::initialize();
        $this->setSource('dd_order');

        // 动态更新
        $this->useDynamicUpdate(true);

        // 订单-订单详情，一对多
        $this->hasMany(
            "id",
            "\Asa\Erp\DdOrderdetails",
            "orderid",
            [
                'alias' => 'orderdetails',
                'foreignKey' => [
                    // 关联字段存在性验证
                    'action' => Relation::ACTION_RESTRICT,
                    "message"    => $this->getValidateMessage('hasmany-foreign-message', 'orderdetail'),
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
