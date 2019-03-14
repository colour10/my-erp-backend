<?php

namespace Asa\Erp;

use Phalcon\Validation;
use Phalcon\Validation\Validator\Uniqueness;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\Regex;
use Asa\Erp\Util;
use Phalcon\Mvc\Model\Relation;

/**
 * 分组表
 */
class TbGroup extends BaseModel
{
    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_group');

        // 组-权限组关联，一对多
        $this->hasMany(
            "id",
            "\Asa\Erp\TbPermissionGroup",
            "groupid",
            [
                'alias' => 'permissions',
                'foreignKey' => [
                    // 关联字段禁止自动删除
                    'action' => Relation::ACTION_RESTRICT,
                    "message"    => "The group cannot be deleted because other permissions are using it"
                ],
            ]
        );

        // 组-用户关联，一对多
        $this->hasMany(
            'id',
            '\Asa\Erp\TbUser',
            'groupid',
            [
                'alias' => 'users',
                'foreignKey' => [
                    // 关联字段禁止自动删除
                    'action' => Relation::ACTION_RESTRICT,
                    "message"    => "The group cannot be deleted because other users are using it"
                ],
            ]
        );
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
     * 获取当前用户组下面的所有模块权限
     * @return false|string
     */
    public function modules()
    {
        // 逻辑
        // 初始化一个空数组，用于存放变量
        $current_modules = [];

        // 循环得到权限
        foreach ($this->permissions as $permission) {
            if ($permission->sys_delete_flag == '0') {
                foreach ($permission->modules as $module) {
                    if ($module->sys_delete_flag == '0') {
                        $current_modules[] = [
                            'permissionid' => $module->permissionid,
                            'module' => $module->module,
                            'controller' => $module->controller,
                            'action' => $module->action,
                        ];
                    }
                }
            }
        }

        // 返回最终的权限树
        return json_encode($current_modules);
    }

}
