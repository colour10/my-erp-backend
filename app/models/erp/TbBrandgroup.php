<?php

namespace Asa\Erp;

use Phalcon\Validation;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\Uniqueness;
use Phalcon\Mvc\Model\Relation;

/**
 * 品类表
 */
class TbBrandgroup extends BaseModel
{
    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_brandgroup');

        // 品类-子品类，一对多
        $this->hasMany(
            "id",
            "\Asa\Erp\TbBrandgroupchild",
            "brandgroupid",
            [
                'alias' => 'brandgroupchilds',
                'foreignKey' => [
                    // 关联字段存在性验证
                    'action' => Relation::ACTION_RESTRICT,
                    "message"    => $this->getValidateMessage('hasmany-foreign-message', 'child-product-group'),
                ],
            ]
        );

        // 设置当前语言
        //$this->setValidateLanguage($this->getLanguage()['lang']);
    }

    /**
     * 设置多语言字段
     * @return array
     */
    function getLanguageColumns() {
        return ['name'];
    }

    /**
     * 验证器
     * @return bool
     */
    public function validation()
    {
        $validator = new Validation();

        $name = $this->getColumnName("name");
        //echo $name;
        // name-品类名称不能为空或者重复
        $validator->add($name, new PresenceOf([
            'message' => $this->getValidateMessage('required', 'name'),
            'cancelOnFail' => true,
        ]));
        $validator->add($name, new Uniqueness([
            'message' => $this->getValidateMessage('uniqueness', 'name'),
            'cancelOnFail' => true,
        ]));
        // code-品类编码
        $validator->add('code', new PresenceOf([
            'message' => $this->getValidateMessage('required', 'code'),
            'cancelOnFail' => true,
        ]));
        $validator->add('code', new Uniqueness([
            'message' => $this->getValidateMessage('uniqueness', 'code'),
            'cancelOnFail' => true,
        ]));

        // 过滤
        $validator->setFilters($name, 'trim');

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