<?php

namespace Asa\Erp;

/**
 * 发货单明细表
 */
class TbShippingDetail extends BaseModel
{
    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_shipping_detail');

        $this->belongsTo(
            'orderdetailsid',
            '\Asa\Erp\TbOrderdetails',
            'id',
            [
                'alias' => 'orderdetails',
            ]
        );

        $this->belongsTo(
            'orderid',
            '\Asa\Erp\TbOrder',
            'id',
            [
                'alias' => 'order',
            ]
        );

        $this->belongsTo(
            'shippingid',
            '\Asa\Erp\TbShipping',
            'id',
            [
                'alias' => 'shipping',
            ]
        );
    }

    public function warehousing()
    {
        //修改库存
        $productStock = $this->getProductStock();
        return $productStock->addStock($detail->number, TbProductstock::WAREHOSING, $this->id);
    }

    public function getProductStock()
    {
        //默认自采
        $property = 1;
        if ($this->order && $this->order->property > 0) {
            $property = $this->order->property;
        }

        return TbProductstock::getProductStock($this->productid, $this->sizecontentid, $this->shipping->warehouseid, $property);
    }

    public function getCost($currencyid)
    {
        //摊销费用计算
        return TbExchangeRate::convert($this->companyid, $this->currencyid, $currencyid, $this->warehousingnumber * $this->price);
    }
}
