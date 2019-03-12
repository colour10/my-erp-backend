<?php

namespace Asa\Erp;

use Phalcon\Validation;
use Phalcon\Validation\Validator\PresenceOf;

/**
 * 权限-组模型
 */
class TbPermissionGroup extends BaseModel
{
    /**
     * 初始化
     */
    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_permission_group');
    }

    /**
     * 验证器
     * @return bool
     */
    public function validation()
    {
        $validator = new Validation();

        // groupid-组id不能为空
        $validator->add('groupid', new PresenceOf([
            'message' => 'The groupid is required',
            'cancelOnFail' => true,
        ]));
        // permissionid-权限id不能为空
        $validator->add('permissionid', new PresenceOf([
            'message' => 'The permissionid is required',
            'cancelOnFail' => true,
        ]));
        // companyid-公司id不能为空
        $validator->add('companyid', new PresenceOf([
            'message' => 'The permissionid is required',
            'cancelOnFail' => true,
        ]));

        return $this->validate($validator);
    }
}
