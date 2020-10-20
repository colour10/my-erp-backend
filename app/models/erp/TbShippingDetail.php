<?php

namespace Asa\Erp;

use Phalcon\Mvc\Model;

/**
 * 发货单明细表
 *
 * Class TbShippingDetail
 * @package Asa\Erp
 * @property int $id 主键id
 * @property int|null $shippingid 发货单id
 * @property int|null $productid 产品id
 * @property int|null $sizecontentid 尺码id
 * @property float|null $price 价格
 * @property float|null $discount 折扣率
 * @property int|null $number 数量
 * @property int|null $orderid 订单id
 * @property int|null $orderdetailid 明细表id
 * @property null $createdate 创建时间
 * @property int|null $warehousingnumber 入库数量
 * @property int|null $orderbrandid 客户订单id
 * @property int|null $orderbranddetailid 客户订单明细id
 * @property int|null $currencyid 币种id
 * @property float|null $cost 成本价
 * @property int|null $costcurrency 成本价的货币单位
 * @property float|null $factoryprice 出厂价
 * @property-read TbOrderdetails|null $orderdetails 订单明细
 * @property-read TbOrder|null $order 订单
 * @property-read TbShipping|null $shipping 发货单
 */
class TbShippingDetail extends BaseModel
{
    /**
     * 初始化
     */
    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_shipping_detail');

        // 发货单明细表-订单明细，一对多反向
        $this->belongsTo(
            'orderdetailsid',
            TbOrderdetails::class,
            'id',
            [
                'alias' => 'orderdetails',
            ]
        );

        // 发货单明细表-订单，一对多反向
        $this->belongsTo(
            'orderid',
            TbOrder::class,
            'id',
            [
                'alias' => 'order',
            ]
        );

        // 发货单明细表-发货单，一对多反向
        $this->belongsTo(
            'shippingid',
            TbShipping::class,
            'id',
            [
                'alias' => 'shipping',
            ]
        );
    }

    public function warehousing()
    {
        // 修改库存
        $productStock = $this->getProductStock();
        return $productStock->addStock($this->number, TbProductstock::WAREHOSING, $this->id);
    }

    /**
     * 获取库存
     *
     * @return TbProductstock|Model
     * @throws Exception
     */
    public function getProductStock()
    {
        // 默认自采
        $property = 1;
        if ($this->order && $this->order->property > 0) {
            $property = $this->order->property;
        }

        return TbProductstock::getProductStock($this->productid, $this->sizecontentid, $this->shipping->warehouseid, $property);
    }

    /**
     * 费用摊销
     *
     * @param $currencyid
     * @return array
     * @throws \Exception
     */
    public function getCost($currencyid)
    {
        // 摊销费用计算
        return TbExchangeRate::convert($this->companyid, $this->currencyid, $currencyid, $this->warehousingnumber * $this->price);
    }
}
