<?php

namespace Asa\Models\Temp;

use Phalcon\Validation;
use Asa\Erp\BaseModel;

/**
 * 基础资料，品牌表
 */
class TempTbBrand extends BaseModel
{
    public function initialize()
    {
        parent::initialize();
        $this->setSource('temp_tb_brand');

        // 品牌表-国家表，一对多反向
        $this->belongsTo(
            'oldcountryid',
            '\Asa\Models\Temp\TempTbCountry',
            'oldid',
            [
                'alias' => 'country'
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
