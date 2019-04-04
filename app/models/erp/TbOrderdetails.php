<?php

namespace Asa\Erp;

use Phalcon\Validation;
use Phalcon\Validation\Validator\Uniqueness;
use Phalcon\Mvc\Model\Relation;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\Regex;

/**
 * 订单明细表
 */
class TbOrderdetails extends BaseModel
{
    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_orderdetails');

        // 订单详情-商品主表，一对多反向
        $this->belongsTo(
            'productid',
            '\Asa\Erp\TbProduct',
            'id',
            [
                'alias' => 'product'
            ]
        );

        // 订单详情-商品尺码表，一对多反向
        $this->belongsTo(
            'sizecontentid',
            '\Asa\Erp\TbSizecontent',
            'id',
            [
                'alias' => 'sizecontent'
            ]
        );

        // 订单详情-商品主表，一对多反向
        $this->belongsTo(
            'orderid',
            '\Asa\Erp\TbOrder',
            'id',
            [
                'alias' => 'order'
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

        // orderid-订单编号不能为空
        $validator->add('orderid', new PresenceOf([
            'message' => $this->getValidateMessage('required', 'orderid'),
            'cancelOnFail' => true,
        ]));

        // sizecontentid-尺码编号不能为空
        $validator->add('sizecontentid', new PresenceOf([
            'message' => $this->getValidateMessage('required', 'sizecontentid'),
            'cancelOnFail' => true,
        ]));

        // number-数量允许为0
        $validator->add('number', new Regex([
            'message' => $this->getValidateMessage('required', 'number'),
            "pattern" => "/^\d+$/",
            'cancelOnFail' => true,
        ]));

        // companyid-公司编号不能为空
        $validator->add('companyid', new PresenceOf([
            'message' => $this->getValidateMessage('required', 'companyid'),
            'cancelOnFail' => true,
        ]));

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
