<?php
namespace Asa\Erp;
use Phalcon\Validation;
use Phalcon\Validation\Validator\Between;
use Phalcon\Validation\Validator\Uniqueness;
//use Phalcon\Mvc\Model\Relation;

/**
 * 调拨单相关，调拨单明细表
 */
class TbRequisitionDetail extends BaseCommonModel
{
    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_requisition_detail');

        // 库存-仓库表，一对多反向
       $this->belongsTo(
            'out_productstockid',
            '\Asa\Erp\TbProductstock',
            'id',
            [
                'alias' => 'outProductstock'
            ]
        );

       $this->belongsTo(
            'in_productstockid',
            '\Asa\Erp\TbProductstock',
            'id',
            [
                'alias' => 'inProductstock'
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

    function delete() {
        return false;
    }
}
