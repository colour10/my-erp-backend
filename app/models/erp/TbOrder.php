<?php

namespace Asa\Erp;

/**
 * 订单主表
 */
class TbOrder extends BaseModel
{
    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_order');

        // 动态更新
        $this->useDynamicUpdate(true);

        // 订单-订单详情，一对多
        $this->hasMany(
            "id",
            "\Asa\Erp\TbOrderdetails",
            "orderid",
            [
                'alias' => 'orderdetails'
            ]
        );
    }

    public function getRules() {
        $factory = $this->getValidatorFactory();
        return [
            'ageseason' => $factory->tableid('niandaijijie'),
            'supplierid' => $factory->tableid('gonghuoshang')
        ];
    }

    /**
     * 添加一条明细数据
     * @param [type] $form 表单数据
     */
    public function addDetail($form) {
        $row = new TbOrderdetails();
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
        $row = TbOrderdetails::findFirst(
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
