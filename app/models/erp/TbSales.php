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
                'alias' => 'salesdetails'
            ]
        );

        $this->belongsTo(
            'saleportid',
            '\Asa\Erp\TbSaleport',
            'id',
            [
                'alias' => 'saleport'
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

    /**
     * 添加一条明细数据
     * @param [type] $form 表单数据
     */
    public function addDetail($form) {
        $row = new TbSalesdetails();
        if($row->create($form)) {
            return $row;
        }
        else {
            $row->debug();
            return false;
        }
    }

    /**
     * 更新明细数据
     * @param  [type] $form 表单数据
     * @return [type]       [description]
     */
    public function updateDetail($form) {
        $row = TbSalesdetails::findFirst(
            sprintf("id=%d", $form['id'])
        );

        if($row!=false) {
            if($row->update($form)) {
                return $row;
            }
            else {
                //$row->debug();
                return false;
            }
        }
        else {
            return false;
        }
    }

    function getOrderDetail() {        
        $data = [
            'form' => $this->toArray(),
            'list'=>[]
        ];

        // 循环添加数据
        foreach ($this->salesdetails as $k => $detail) {
            $orderdetail_array = $detail->toArray();
            $productstock = $detail->productstock;

            $orderdetail_array['productname'] = $productstock->product->productname;
            $orderdetail_array['sizecontentid'] = $productstock->sizecontentid;
            $orderdetail_array['price'] = $productstock->goods->price;
            $orderdetail_array['productstock'] = $detail->productstock->toArray();
            $data['list'][] = $orderdetail_array;
        }

        return $data;
    }
}
