<?php

namespace Asa\Erp;

use Phalcon\Validation;
use Phalcon\Validation\Validator\Uniqueness;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\Regex;

/**
 * 角色表，也就是组信息表
 */
class Role extends BaseModel
{
    /**
     * 初始化
     */
    public function initialize()
    {
        parent::initialize();
        $this->setSource('role');
    }

    /**
     * 验证器
     * @return bool
     */
    public function validation()
    {
        $validator = new Validation();

        // name-角色名称不能为空或者重复
        $validator->add('name', new PresenceOf([
            'message' => 'The name is required',
            'cancelOnFail' => true,
        ]));
        $validator->add('name', new Uniqueness([
            'message' => 'The name field must be unique',
            'cancelOnFail' => true,
        ]));
        // relateid-关联ID
        $validator->add('relateid', new Regex(
            [
                "message" => "The relateid is invalid",
                "pattern" => "/[0-9]+/",
                "allowEmpty" => true,
                'cancelOnFail' => true,
            ]
        ));
        // lang_code-语言编码
        $validator->add('lang_code', new Regex(
            [
                "message" => "The lang_code is invalid",
                "pattern" => "/[a-zA-Z\-_0-9]+/",
                "allowEmpty" => true,
                'cancelOnFail' => true,
            ]
        ));
        // languages-语言列表
        $validator->add('languages', new Regex(
            [
                "message" => "The languages is invalid",
                "pattern" => "/[a-zA-Z0-9\-\_\,]+/",
                "allowEmpty" => true,
                'cancelOnFail' => true,
            ]
        ));
        // 过滤
        $validator->setFilters('name', 'trim');

        return $this->validate($validator);
    }
}
