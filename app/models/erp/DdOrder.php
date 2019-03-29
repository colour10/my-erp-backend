<?php

namespace Asa\Erp;

use Phalcon\Validation;
use Phalcon\Validation\Validator\Uniqueness;
use Phalcon\Mvc\Model\Relation;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\Regex;

/**
 * 订单主表
 */
class DdOrder extends BaseModel
{
    public function initialize()
    {
        parent::initialize();
        $this->setSource('dd_order');

        // 动态更新
        $this->useDynamicUpdate(true);

        // 订单-订单详情，一对多
        $this->hasMany(
            "id",
            "\Asa\Erp\DdOrderdetails",
            "orderid",
            [
                'alias' => 'orderdetails'
            ]
        );
    }

    /**
     * 验证器
     * 因为采用特殊的json参数传值，所以不同于一般的验证
     * @return bool
     */
    public function validation()
    {
        $validator = new Validation();

        // 开始验证
        // 必填字段为：年代id-ageseason；供货商id-supplierid
        // 年代id-ageseason不能为空
        $validator->add('ageseason', new PresenceOf([
            'message' => $this->getValidateMessage('required', 'ageseason'),
            'cancelOnFail' => true,
        ]));

        // 年代id-ageseason必须是正整数
        $validator->add('ageseason', new Regex([
            'message' => $this->getValidateMessage('invalid', 'ageseason'),
            "pattern" => "/^[0-9]+$/",
            'cancelOnFail' => true,
        ]));

        // 供货商id-supplierid不能为空
        $validator->add('supplierid', new PresenceOf([
            'message' => $this->getValidateMessage('required', 'supplierid'),
            'cancelOnFail' => true,
        ]));

        // 供货商id-supplierid必须是正整数
        $validator->add('supplierid', new Regex([
            'message' => $this->getValidateMessage('invalid', 'supplierid'),
            "pattern" => "/^[0-9]+$/",
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

    /**
     * 添加一条明细数据
     * @param [type] $form 表单数据
     */
    public function addDetail($form) {
        $row = new DdOrderdetails();
        if($row->create($form)) {
            return $row;
        }
        else {
            return false;
        }
    }

    /**
     * 更新明细数据
     * @param  [type] $form 表单数据
     * @return [type]       [description]
     */
    public function updateDetail($form) {
        $row = DdOrderdetails::findFirst(
            sprintf("id=%d", $form['id'])
        );

        if($row!=false && $row->companyid == $form['companyid']) {
            if($row->update($form)) {
                return $row;
            }
            else {
                return false;
            }
        }
        else {
            return false;
        }
    }

    /**
     * 
     */
    function getOrderDetail() {        
        $data = [
            'form' => $this->toArray(),
            'list'=>[]
        ];

        // 循环添加数据
        foreach ($this->orderdetails as $k => $orderdetail) {
            $orderdetail_array = $orderdetail->toArray();
            $orderdetail_array['product'] = $orderdetail->product->toArray();
            $data['list'][] = $orderdetail_array;
        }

        return $data;
    }
}
