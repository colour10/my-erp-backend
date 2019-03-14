<?php

namespace Asa\Erp;

use Phalcon\Validation;
use Phalcon\Validation\Validator\Uniqueness;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\Regex;
use Phalcon\Mvc\Model\Relation;

/**
 * 权限表
 */
class TbPermission extends BaseModel
{
    /**
     * 初始化
     */
    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_permission');

        // 权限-权限组关联表，一对多
        $this->hasMany(
            "id",
            "\Asa\Erp\TbPermissionGroup",
            "permissionid",
            [
                'alias' => 'groups',
                'foreignKey' => [
                    // 关联字段禁止自动删除
                    'action' => Relation::ACTION_RESTRICT,
                    "message"    => "The permission cannot be deleted because other groups are using it"
                ],
            ]
        );

        // 权限-权限模型关联表，一对多
        $this->hasMany(
            "id",
            "\Asa\Erp\TbPermissionModule",
            "permissionid",
            [
                'alias' => 'modules',
                'foreignKey' => [
                    // 关联字段禁止自动删除
                    'action' => Relation::ACTION_RESTRICT,
                    "message"    => "The permission cannot be deleted because other modules are using it"
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

        // name-权限名称不能为空或者重复
        $validator->add('name', new PresenceOf([
            'message' => $this->getValidateMessage('required', 'permission-name'),
            'cancelOnFail' => true,
        ]));
        $validator->add('name', new Uniqueness([
            'message' => $this->getValidateMessage('uniqueness', 'permission-name'),
            'cancelOnFail' => true,
        ]));
        // pid-父级别权限
        $validator->add('pid', new Regex(
            [
                "message" => $this->getValidateMessage('invalid', 'permission-pid'),
                "pattern" => "/^[1-9]\d*$/",
                "allowEmpty" => true,
                'cancelOnFail' => true,
            ]
        ));
        // 过滤
        $validator->setFilters('name', 'trim');
        // 最终返回
        return $this->validate($validator);
    }

    // 重写验证提示方法
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
