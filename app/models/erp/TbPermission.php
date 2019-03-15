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
                    // 关联字段存在性验证
                    'action' => Relation::ACTION_RESTRICT,
                    "message"    => $this->getValidateMessage('hasmany-foreign-message', 'group'),
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
                    // 关联字段存在性验证
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
