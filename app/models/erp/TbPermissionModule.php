<?php

namespace Asa\Erp;

use Phalcon\Validation;
use Phalcon\Validation\Validator\Regex;
use Phalcon\Mvc\Model\Relation;

/**
 * 权限模型关联表
 */
class TbPermissionModule extends BaseModel
{
    /**
     * 初始化
     */
    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_permission_module');

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
                    "message" => $this->getValidateMessage('notexist', 'permission'),
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

        // permissionid-权限id
        $validator->add('permissionid', new Regex(
            [
                'message' => $this->getValidateMessage('invalid', 'permissionid'),
                "pattern" => "/^[1-9]\d*$/",
                "allowEmpty" => true,
                'cancelOnFail' => true,
            ]
        ));

        // 返回验证结果
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
