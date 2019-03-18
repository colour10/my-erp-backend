<?php

namespace Asa\Erp;

use Phalcon\Validation;
use Phalcon\Validation\Validator\Uniqueness;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Mvc\Model\Relation;

/**
 * 商品尺码明细信息表
 */
class ZlSizecontent extends BaseModel
{
    public function initialize()
    {
        parent::initialize();
        $this->setSource('zl_sizecontent');

        // 设置当前语言
        $this->setValidateLanguage($this->getLanguage()['lang']);
    }

    /**
     * 设置多语言字段
     * @return array
     */
    function getLanguageColumns() {
        return ['content', 'memo'];
    }

    /**
     * 验证器
     * @return bool
     */
    public function validation()
    {
        $validator = new Validation();

        $content = $this->getColumnName("content");
        // $content-尺寸代码名称不能为空或者重复
        $validator->add($content, new PresenceOf([
            'message' => $this->getValidateMessage('required', 'sizecontent-content'),
            'cancelOnFail' => true,
        ]));
        $validator->add($content, new Uniqueness([
            'message' => $this->getValidateMessage('uniqueness', 'sizecontent-content'),
            'cancelOnFail' => true,
        ]));

        $memo = $this->getColumnName("memo");
        // $memo-尺寸描述
        $validator->add($memo, new PresenceOf([
            'message' => $this->getValidateMessage('required', 'sizecontent-memo'),
            'cancelOnFail' => true,
        ]));
        $validator->add($memo, new Uniqueness([
            'message' => $this->getValidateMessage('uniqueness', 'sizecontent-memo'),
            'cancelOnFail' => true,
        ]));

        // 过滤
        $validator->setFilters($content, 'trim');
        $validator->setFilters($memo, 'trim');

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
