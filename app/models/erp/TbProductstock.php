<?php

namespace Asa\Erp;

use Phalcon\Validation;
use Phalcon\Validation\Validator\Uniqueness;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\Regex;
use Phalcon\Mvc\Model\Relation;

/**
 * 库存表
 */
class TbProductstock extends BaseCommonModel
{
    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_productstock');

        // 库存-商品主表，一对多反向
        $this->belongsTo(
            'productid',
            '\Asa\Erp\TbProduct',
            'id',
            [
                'alias' => 'product',
                "foreignKey" => [
                    // 关联字段存在性验证
                    'action' => Relation::ACTION_RESTRICT,
                    "message" => $this->getValidateMessage('notexist', 'product'),
                ],
            ]
        );

        // 库存-尺码表，一对多反向
        $this->belongsTo(
            'sizecontentid',
            '\Asa\Erp\ZlSizecontent',
            'id',
            [
                'alias' => 'sizecontent',
                "foreignKey" => [
                    // 关联字段存在性验证
                    'action' => Relation::ACTION_RESTRICT,
                    "message" => $this->getValidateMessage('notexist', 'sizecontent'),
                ],
            ]
        );

        // 库存-仓库表，一对多反向
        $this->belongsTo(
            'warehouseid',
            '\Asa\Erp\TbWarehouse',
            'id',
            [
                'alias' => 'warehouse',
                "foreignKey" => [
                    // 关联字段存在性验证
                    'action' => Relation::ACTION_RESTRICT,
                    "message" => $this->getValidateMessage('notexist', 'warehouse'),
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

        // productid-商品编号不能为空
        $validator->add('productid', new PresenceOf([
            'message' => $this->getValidateMessage('required', 'productid'),
            'cancelOnFail' => true,
        ]));

        // number-商品库存数量不能为空
        $validator->add('number', new PresenceOf([
            'message' => $this->getValidateMessage('required', 'number'),
            'cancelOnFail' => true,
        ]));

        // number-商品库存数量不能为空
        $validator->add('number', new Regex([
            'message' => $this->getValidateMessage('invalid', 'number'),
            "pattern" => "/^[0-9]+$/",
            'cancelOnFail' => true,
        ]));

        // sizecontentid-尺码编号不能为空
        $validator->add('sizecontentid', new PresenceOf([
            'message' => $this->getValidateMessage('required', 'sizecontentid'),
            'cancelOnFail' => true,
        ]));

        // warehouseid-仓库编号不能为空
        $validator->add('warehouseid', new PresenceOf([
            'message' => $this->getValidateMessage('required', 'warehouseid'),
            'cancelOnFail' => true,
        ]));

        // 商品id，尺码id，仓库id建立唯一性索引
        $validator->add(['productid', 'sizecontentid', 'warehouseid'], new Uniqueness([
            'message' => $this->getValidateMessage('uniqueness', 'productstock-productid-sizecontentid-warehouseid'),
            'cancelOnFail' => true,
        ]));

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
