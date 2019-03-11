<?php

namespace Asa\Erp;

use Phalcon\Validation;
use Phalcon\Validation\Validator\Uniqueness;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\Regex;

/**
 * 分组表
 */
class TbGroup extends BaseModel
{
    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_group');
    }

    /**
     * 验证器
     * @return bool
     */
    public function validation()
    {
        $validator = new Validation();

        // name-名称不能为空
        $validator->add('group_name', new PresenceOf([
            'message' => 'The group_name is required',
            'cancelOnFail' => true,
        ]));
        // companyid-所属公司ID
        $validator->add('companyid', new Regex(
            [
                "message" => "The companyid is invalid",
                "pattern" => "/[0-9]+/",
                "allowEmpty" => true,
                'cancelOnFail' => true,
            ]
        ));
        // 过滤
        $validator->setFilters('group_name', 'trim');

        return $this->validate($validator);
    }
}
