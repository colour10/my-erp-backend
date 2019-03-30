<?php

namespace Asa\Erp;

use Phalcon\Validation;
use Phalcon\Validation\Validator\Uniqueness;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\Regex;
use Phalcon\Mvc\Model\Relation;

/**
 * 公司域名表
 */
class TbCompanyhost extends BaseModel
{
    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_companyhost');

        // 公司域名表-公司表，一对多反向
        $this->belongsTo(
            'countryid',
            '\Asa\Erp\ZlCountry',
            'id',
            [
                'alias' => 'country',
                "foreignKey" => [
                    // 关联字段存在性验证
                    'action' => Relation::ACTION_RESTRICT,
                    "message" => $this->getValidateMessage('notexist', 'country'),
                ],
            ]
        );
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

        // name-公司名称不能为空或者重复
        $validator->add('url', new PresenceOf([
            'message' => $this->getValidateMessage('required', 'url'),
            'cancelOnFail' => true,
        ]));
        $validator->add('url', new Uniqueness([
            'message' => $this->getValidateMessage('uniqueness', 'url'),
            'cancelOnFail' => true,
        ]));
        // companyid-公司ID
        $validator->add('companyid', new Regex(
            [
                'message' => $this->getValidateMessage('invalid', 'companyid'),
                "pattern" => "/^[1-9]\d*$/",
                'cancelOnFail' => true,
            ]
        ));
        
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
