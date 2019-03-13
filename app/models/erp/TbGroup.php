<?php

namespace Asa\Erp;

use Phalcon\Validation;
use Phalcon\Validation\Validator\Uniqueness;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\Regex;
use Asa\Erp\Util;

/**
 * 分组表
 */
class TbGroup extends BaseModel
{
    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_group');

        // 组-权限组关联表，一对多
        $this->hasMany("id", "\Asa\Erp\TbPermissionGroup", "groupid", [
            'alias' => 'permissiongroup',
        ]);
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
                "pattern" => "/^[1-9]\d*$/",
                "allowEmpty" => true,
                'cancelOnFail' => true,
            ]
        ));
        // 过滤
        $validator->setFilters('group_name', 'trim');

        return $this->validate($validator);
    }


    /**
     * 获取当前用户组下面的所有权限
     * @return false|string
     */
    public function permissions()
    {
        // 逻辑
        // 初始化一个空数组，用于存放变量
        $permissions = [];

        // 循环得到权限
        foreach ($this->permissiongroup as $permissiongroup) {
            if ($permissiongroup->sys_delete_flag == '0') {
                foreach ($permissiongroup->permissionmodule as $permissionmodule) {
                    if ($permissionmodule->sys_delete_flag == '0') {
                        $permissions[] = [
                            'module' => $permissionmodule->module,
                            'controller' => $permissionmodule->controller,
                            'action' => $permissionmodule->action,
                        ];
                    }
                }
            }
        }

        // 返回最终的权限树
        return json_encode($permissions);
    }

}
