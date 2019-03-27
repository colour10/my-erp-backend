<?php

namespace Asa\Erp;

use Phalcon\Validation;
use Phalcon\Validation\Validator\Uniqueness;
use Phalcon\Mvc\Model\Relation;
use Phalcon\Validation\Validator\Regex;

/**
 * 销售单主表
 */
class TbSales extends BaseModel
{
    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_sales');

        // 订单-订单详情，一对多
        $this->hasMany(
            "id",
            "\Asa\Erp\TbSalesdetails",
            "salesid",
            [
                'alias' => 'salesdetails',
                'foreignKey' => [
                    // 关联字段存在性验证
                    // 销售单只有预售的可以做退货处理，剩下的都不能删除
                    'action' => Relation::ACTION_RESTRICT,
                    "message"    => $this->getValidateMessage('hasmany-foreign-message', 'orderdetail'),
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

        // 验证
        // memberid-会员id
        $validator->add('memberid', new Regex(
            [
                'message' => $this->getValidateMessage('invalid', 'memberid'),
                "pattern" => "/^[1-9]+\d*$/",
                "allowEmpty" => true,
                'cancelOnFail' => true,
            ]
        ));

        // salesstaff-销售者id
        $validator->add('salesstaff', new Regex(
            [
                'message' => $this->getValidateMessage('invalid', 'salesstaff'),
                "pattern" => "/^[1-9]+\d*$/",
                "allowEmpty" => true,
                'cancelOnFail' => true,
            ]
        ));

        // sellspotid-销售端口id
        $validator->add('sellspotid', new Regex(
            [
                'message' => $this->getValidateMessage('invalid', 'sellspotid'),
                "pattern" => "/^[1-9]+\d*$/",
                "allowEmpty" => true,
                'cancelOnFail' => true,
            ]
        ));

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
