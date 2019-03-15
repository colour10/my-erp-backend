<?php

namespace Asa\Erp;

use Phalcon\Validation;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Mvc\Model\Relation;

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

        // 表关联
        // 与组表关联，一对多反向
        $this->belongsTo(
            "groupid",
            "\Asa\Erp\TbGroup",
            "id",
            [
                'alias' => 'group',
                'foreignKey' => [
                    // 关联字段禁止自动删除
                    'action' => Relation::ACTION_RESTRICT,
                    "message"    => $this->getValidateMessage('belongsto-foreign-message', 'group'),
                ],
            ]
        );

        // 与权限表关联，一对多反向
        $this->belongsTo(
            "permissionid",
            "\Asa\Erp\TbPermission",
            "id",
            [
                'alias' => 'permission',
                'foreignKey' => [
                    // 关联字段禁止自动删除
                    'action' => Relation::ACTION_RESTRICT,
                    "message"    => $this->getValidateMessage('belongsto-foreign-message', 'permission'),
                ],
            ]
        );

        // 与权限模型关联，一对多
        $this->hasMany(
            'permissionid',
            '\Asa\Erp\TbPermissionModule',
            'permissionid',
            [
                'alias' => 'modules',
                'foreignKey' => [
                    // 关联字段禁止自动删除
                    'action' => Relation::ACTION_RESTRICT,
                    "message"    => $this->getValidateMessage('hasmany-foreign-message', 'permission-module'),
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

        // groupid-组id不能为空
        $validator->add('groupid', new PresenceOf([
            'message' => $this->getValidateMessage('required', 'groupid'),
            'cancelOnFail' => true,
        ]));
        // permissionid-权限id不能为空
        $validator->add('permissionid', new PresenceOf([
            'message' => $this->getValidateMessage('required', 'permissionid'),
            'cancelOnFail' => true,
        ]));
        // companyid-公司id不能为空
        $validator->add('companyid', new PresenceOf([
            'message' => $this->getValidateMessage('required', 'companyid'),
            'cancelOnFail' => true,
        ]));

        return $this->validate($validator);
    }

    // 重写方法
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
