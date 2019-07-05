<?php

namespace Asa\Erp;

/**
 * 销售单主表
 * ErrorCode 1108
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

        $this->belongsTo(
            'warehouseid',
            '\Asa\Erp\TbWarehouse',
            'id',
            [
                'alias' => 'warehouse'
            ]
        );
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
            throw new \Exception("/11080101/添加销售明细失败/");
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
                throw new \Exception("/11080201/销售明细更新失败。/");
            }
        }
        else {
            throw new \Exception("/11080202/销售明细不存在。/");
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
