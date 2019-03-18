<?php

namespace Asa\Erp;

use Phalcon\Validation;
use Phalcon\Validation\Validator\Between;
use Phalcon\Validation\Validator\Uniqueness;
use Phalcon\Mvc\Model\Relation;

/**
 * 订单明细表
 */
class DdOrderdetails extends BaseModel
{
    public function initialize()
    {
        parent::initialize();
        $this->setSource('dd_orderdetails');

        // 订单详情-商品主表，一对多反向
        $this->belongsTo(
            'productid',
            '\Asa\Erp\TbProduct',
            'id',
            [
                'alias' => 'product',
                "foreignKey" => [
                    // 关联字段存在性验证
                    'action' => Relation::ACTION_RESTRICT,
                    "message" => $this->getValidateMessage('notexist', 'product'),
                ],
            ]
        );

        // 订单详情-商品尺码表，一对多反向
        $this->belongsTo(
            'sizecontentid',
            '\Asa\Erp\ZlSizecontent',
            'id',
            [
                'alias' => 'sizecontent',
                "foreignKey" => [
                    // 关联字段存在性验证
                    'action' => Relation::ACTION_RESTRICT,
                    "message" => $this->getValidateMessage('notexist', 'sizecontent'),
                ],
            ]
        );

        // 订单详情-商品主表，一对多反向
        $this->belongsTo(
            'orderid',
            '\Asa\Erp\DdOrder',
            'id',
            [
                'alias' => 'order',
                "foreignKey" => [
                    // 关联字段存在性验证
                    'action' => Relation::ACTION_RESTRICT,
                    "message" => $this->getValidateMessage('notexist', 'order'),
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
