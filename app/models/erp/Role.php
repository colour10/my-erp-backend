<?php
namespace Asa\Erp;
use Phalcon\Validation;
use Phalcon\Validation\Validator\Between;
use Phalcon\Validation\Validator\Uniqueness;

class Role extends BaseModel
{
    public function initialize()
    {
        //$this->setConnectionService('db_workshop');
        $this->setSource('role');
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
        $validator->add(
            'name',
            new Uniqueness(
                [
                    'message' => '组名称不能重复',
                ]
            )
        );

        return $this->validate($validator);
    }
}