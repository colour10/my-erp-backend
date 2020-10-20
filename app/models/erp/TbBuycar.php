<?php

namespace Asa\Erp;

use Phalcon\Mvc\Model\Relation;
use Phalcon\Validation;

/**
 * 购物车表
 *
 * Class TbBuycar
 * @package Asa\Erp
 * @property int $id 主键id
 * @property int|null $product_id 商品id
 * @property string|null $product_name 商品名称
 * @property int|null $color_id 颜色id
 * @property string|null $color_name 颜色名称
 * @property int|null $size_id 规格id
 * @property string|null $size_name 规格名称
 * @property int|null $member_id 用户id
 * @property int|null $number 数量
 * @property float|null $price 价格
 * @property float|null $total_price 总价格
 * @property string|null $picture 商品主图
 * @property string|null $picture2 商品附图
 * @property-read TbMember|null $member 用户
 * @property-read TbProductSearch|null $product 商品
 */
class TbBuycar extends BaseModel
{
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
            TbMember::class,
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
            TbProductSearch::class,
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
     * 验证
     *
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
