<?php

namespace Asa\Erp;

use Phalcon\Validation;
use Phalcon\Validation\Validator\Uniqueness;
use Phalcon\Mvc\Model\Relation;
use Phalcon\Validation\Validator\Regex;

/**
 * 销售单 明细表
 */
class TbSalesdetails extends BaseModel
{
    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_salesdetails');

        // 销售详情表-销售主表，一对多反向
        $this->belongsTo(
            'salesid',
            '\Asa\Erp\TbSales',
            'id',
            [
                'alias' => 'tbsales'
            ]
        );

        $this->belongsTo(
            'productstockid',
            '\Asa\Erp\TbProductstock',
            'id',
            [
                'alias' => 'productstock'
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
