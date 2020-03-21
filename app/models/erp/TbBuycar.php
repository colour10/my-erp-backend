<?php

namespace Asa\Erp;

use Phalcon\Mvc\Model\Relation;
use Phalcon\Validation;

/**
 * 购物车表
 * Class TbBuycar
 * @package Asa\Erp
 */
class TbBuycar extends BaseModel
{

    /**
     * @var
     */
    public $id;

    /**
     * @var
     */
    public $product_id;

    /**
     * @var
     */
    public $product_name;

    /**
     * @var
     */
    public $price;

    /**
     * @var
     */
    public $number;

    /**
     * @var
     */
    public $total_price;

    /**
     * @var
     */
    public $color_id;

    /**
     * @var
     */
    public $color_name;

    /**
     * @var
     */
    public $size_id;

    /**
     * @var
     */
    public $size_name;

    /**
     * @var
     */
    public $member_id;


    /**
     * 初始化
     */
    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_buycar');

        // 表关联
        // 与用户表关联，一对多反向
        $this->belongsTo(
            "member_id",
            "\Asa\Erp\TbMember",
            "id",
            [
                'alias'      => 'member',
                'foreignKey' => [
                    // 关联字段禁止自动删除
                    'action'  => Relation::ACTION_RESTRICT,
                    "message" => $this->getValidateMessage('belongsto-foreign-message', 'member'),
                ],
            ]
        );

        // 与产品表关联，一对多反向
        $this->belongsTo(
            "product_id",
            "\Asa\Erp\TbProductSearch",
            "id",
            [
                'alias'      => 'product',
                'foreignKey' => [
                    // 关联字段禁止自动删除
                    'action'  => Relation::ACTION_RESTRICT,
                    "message" => $this->getValidateMessage('belongsto-foreign-message', 'product'),
                ],
            ]
        );

    }

    /**
     * @return bool
     */
    public function validation()
    {
        $validator = new Validation();

        return $this->validate($validator);
    }
    
    /**
     * 重写多语言版本配置读取函数
     * @param string languages下面语言文件字段的名称 如template模块下面的uniqueness
     * @param string 待验证字段的编号，显示为当前语言的友好性提示 $name
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
