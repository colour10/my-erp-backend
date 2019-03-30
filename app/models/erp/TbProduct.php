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
    private static $box;
    
    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_product');

        // 商品-子品类，一对多反向
        $this->belongsTo(
            'childbrand',
            '\Asa\Erp\ZlChildproductgroup',
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

        // 商品-尺码组，一对多反向
        $this->belongsTo(
            'productsize',
            '\Asa\Erp\ZlSizetop',
            'id',
            [
                'alias' => 'sizetop',
                'foreignKey' => [
                    // 关联字段禁止自动删除
                    'action' => Relation::ACTION_RESTRICT,
                    "message" => $this->getValidateMessage('notexist', 'sizetop'),
                ],
            ]
        );

        // 商品-材质表，一对多反向，因为关联表字段用的是material，所以别名换成了getmaterial
        $this->belongsTo(
            'material',
            '\Asa\Erp\ZlMaterial',
            'id',
            [
                'alias' => 'getmaterial',
                'foreignKey' => [
                    // 关联字段禁止自动删除
                    'action' => Relation::ACTION_RESTRICT,
                    "message" => $this->getValidateMessage('notexist', 'material'),
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

    public static function getInstance($productid) {
        if(!isset(self::$box[$productid])) {
            self::$box[$productid] = TbProduct::findFirstById($productid);
        }

        return self::$box[$productid];
    }
}
