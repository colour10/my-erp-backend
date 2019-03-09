<?php

namespace Asa\Erp;

use Phalcon\Validation;
use Phalcon\Validation\Validator\Uniqueness;
use Phalcon\Validation\Validator\PresenceOf;

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
    public function validation() {
        $validator = new Validation();

        // 验证权限名称不能为空或者重复
        $validator->add('name', new PresenceOf([
            'message' => '权限名称不能为空',
        ]));
        $validator->add('name', new Uniqueness([
            'message' => '权限名称不能重复',
        ]));

        return $this->validate($validator);
    }
}
