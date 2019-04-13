<?php

namespace Asa\Erp;

use Phalcon\Validation;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\Regex;

/**
 * 会员相关，地址信息表
 */
class TbMemberAddress extends BaseModel
{
    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_member_address');

        // 会员地址表-会员表，一对多反向
        $this->belongsTo(
            'member_id',
            '\Asa\Erp\TbMember',
            'id',
            [
                'alias' => 'member',
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

        // member_id不能为空
        $validator->add('member_id', new Regex(
            [
                'message' => $this->getValidateMessage('invalid', 'member_id'),
                "pattern" => "/^[1-9]\d*$/",
                'cancelOnFail' => true,
            ]
        ));

        // name-不能为空
        $validator->add('name', new PresenceOf([
            'message' => $this->getValidateMessage('required', 'name'),
            'cancelOnFail' => true,
        ]));

        // tel-手机
        $validator->add('tel', new Regex(
            [
                'message' => $this->getValidateMessage('invalid', 'mobile'),
                "pattern" => "/^[1-9]\d*$/",
                'cancelOnFail' => true,
            ]
        ));

        // address-不能为空
        $validator->add('address', new PresenceOf([
            'message' => $this->getValidateMessage('required', 'address'),
            'cancelOnFail' => true,
        ]));

        // 过滤
        $validator->setFilters('name', 'trim');
        $validator->setFilters('address', 'trim');

        // 返回
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
