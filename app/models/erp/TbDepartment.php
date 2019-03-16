<?php

namespace Asa\Erp;

use Phalcon\Validation;
use Phalcon\Validation\Validator\Uniqueness;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\Regex;
use Phalcon\Mvc\Model\Relation;

/**
 * 部门表
 */
class TbDepartment extends BaseModel
{
    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_department');

        // 部门-公司表，一对多反向
        $this->belongsTo(
            'companyid',
            '\Asa\Erp\TbCompany',
            'id',
            [
                'alias' => 'company',
                'foreignKey' => [
                    // 关联字段禁止自动删除
                    'action' => Relation::ACTION_RESTRICT,
                    "message" => $this->getValidateMessage('notexist', 'company'),
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

        // name-部门名不能为空
        $validator->add('name', new PresenceOf([
            'message' => $this->getValidateMessage('required', 'name'),
            'cancelOnFail' => true,
        ]));
        // companyid-公司ID
        $validator->add('companyid', new Regex([
            'message' => $this->getValidateMessage('invalid', 'companyid'),
            "pattern" => "/^[1-9]\d*$/",
            'cancelOnFail' => true,
        ]));
        // priceid-销售价格id
        $validator->add('priceid', new Regex([
            'message' => $this->getValidateMessage('invalid', 'priceid'),
            "pattern" => "/^[1-9]\d*$/",
            "allowEmpty" => true,
            'cancelOnFail' => true,
        ]));
        // spotid-销售端口id
        $validator->add('spotid', new Regex([
            'message' => $this->getValidateMessage('invalid', 'spotid'),
            "pattern" => "/^[1-9]\d*$/",
            "allowEmpty" => true,
            'cancelOnFail' => true,
        ]));
        // up_dp_id-上级部门id
        $validator->add('up_dp_id', new Regex([
            'message' => $this->getValidateMessage('invalid', 'up_dp_id'),
            "pattern" => "/^[1-9]\d*$/",
            "allowEmpty" => true,
            'cancelOnFail' => true,
        ]));
        // 过滤
        $validator->setFilters('name', 'trim');

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
