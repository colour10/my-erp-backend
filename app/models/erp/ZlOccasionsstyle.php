<?php
namespace Asa\Erp;
use Phalcon\Validation;
use Phalcon\Validation\Validator\Between;
use Phalcon\Validation\Validator\Uniqueness;

/**
 * 基础资料，场合风格表
 */
class ZlOccasionsstyle extends BaseModel
{
    public function initialize()
    {
        parent::initialize();
        $this->setSource('zl_occasionsstyle');
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
