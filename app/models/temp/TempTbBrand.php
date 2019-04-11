<?php

namespace Asa\Models\Temp;

use Phalcon\Validation;
use Asa\Erp\BaseModel;

/**
 * 基础资料，国家及地区信息表
 */
class TempTbCountry extends BaseModel
{
    public function initialize()
    {
        parent::initialize();
        $this->setSource('temp_tb_country');
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
