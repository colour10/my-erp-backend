<?php

namespace Asa\Erp;

use Phalcon\Validation;
use Phalcon\Validation\Validator\Regex;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\Uniqueness;

/**
 * 年代季节
 */
class ZlAgeseason extends BaseModel
{
    public function initialize()
    {
        parent::initialize();
        $this->setSource('zl_ageseason');
    }


    /**
     * 验证器
     * @return bool
     */
    public function validation()
    {
        $validator = new Validation();

        // name-年代数字不能为空
        $validator->add('name', new PresenceOf([
            'message' => $this->getValidateMessage('required', 'ageseason-name'),
            'cancelOnFail' => true,
        ]));
        $validator->add('name', new Regex(
            [
                'message' => $this->getValidateMessage('invalid', 'ageseason-name'),
                "pattern" => "/^[1-9]\d*$/",
                'cancelOnFail' => true,
            ]
        ));

        // mark-年代英文标识不能为空
        $validator->add('sessionmark', new PresenceOf([
            'message' => $this->getValidateMessage('required', 'ageseason-mark'),
            'cancelOnFail' => true,
        ]));

        // 年代、标识唯一性索引
        $validator->add(['name', 'sessionmark'], new Uniqueness([
            'message' => $this->getValidateMessage('uniqueness', 'ageseason-name-mark'),
            'cancelOnFail' => true,
        ]));

        // 过滤
        $validator->setFilters('name', 'trim');
        $validator->setFilters('sessionmark', 'trim');

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

    public function toArrayPipe() {
        $fullname = sprintf("%s%s", $this->sessionmark, $this->name);
        $array = $this->toArray();
        $array['fullname'] = $fullname;
        return $array;
    }
}