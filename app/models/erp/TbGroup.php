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
                    "message"    => $this->getValidateMessage('hasmany-foreign-message', 'group'),
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
                    "message"    => $this->getValidateMessage('hasmany-foreign-message', 'user'),
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
            'message' => $this->getValidateMessage('required', 'group_name'),
            'cancelOnFail' => true,
        ]));
        // companyid-所属公司ID
        $validator->add('companyid', new Regex(
            [
                'message' => $this->getValidateMessage('invalid', 'companyid'),
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


    /**
     * 重写多语言版本配置读取函数
     * @param languages下面语言文件字段的名称 如template模块下面的uniqueness
     * @param 待验证字段的编号，显示为当前语言的友好性提示 $name
     * @return string
     */
    public function getValidateMessage($template, $name)
    {
        // 定义变量
        // 取出当前语言版本
        $language = $this->getDI()->get('language');
        // 拼接变量
        $template_name = $language->template[$template];
        $human_name = $language->$name;
        // 返回最终的友好提示信息
        return sprintf($template_name, $human_name);
    }
}
