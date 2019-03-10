<?php

namespace Asa\Erp;

use Phalcon\Validation;
use Phalcon\Validation\Validator\Uniqueness;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\Regex;

/**
 * 权限表
 */
class Permission extends BaseModel
{
    /**
     * 初始化
     */
    public function initialize()
    {
        parent::initialize();
        $this->setSource('permission');
    }

    /**
     * 验证器
     * @return bool
     */
    public function validation()
    {
        $validator = new Validation();

        // name-权限名称不能为空或者重复
        $validator->add('name', new PresenceOf([
            'message' => 'The name is required',
            'cancelOnFail' => true,
        ]));
        $validator->add('name', new Uniqueness([
            'message' => 'The name field must be unique',
            'cancelOnFail' => true,
        ]));
        // pid-父级别权限
        $validator->add('pid', new Regex(
            [
                "message" => "The pid is invalid",
                "pattern" => "/[0-9]+/",
                "allowEmpty" => true,
                'cancelOnFail' => true,
            ]
        ));
        // relateid-关联ID
        $validator->add('relateid', new Regex(
            [
                "message" => "The relateid is invalid",
                "pattern" => "/[0-9]+/",
                "allowEmpty" => true,
                'cancelOnFail' => true,
            ]
        ));
        // description-描述
        $validator->add('description', new PresenceOf([
            'message' => 'The description is required',
            'cancelOnFail' => true,
        ]));
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
        $validator->setFilters('description', 'trim');

        return $this->validate($validator);
    }
}
