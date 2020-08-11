<?php

namespace Asa\Erp;

use Phalcon\Mvc\Model;

/**
 * 发货单明细表
 *
 * Class TbShippingDetail
 * @package Asa\Erp
 */
class TbShippingDetail extends BaseModel
{
    /**
     *
     * @var integer
     */
    public $id;

    /**
     *
     * @var integer
     */
    public $shippingid;

    /**
     *
     * @var integer
     */
    public $productid;

    /**
     *
     * @var integer
     */
    public $sizecontentid;

    /**
     *
     * @var double
     */
    public $price;

    /**
     *
     * @var double
     */
    public $discount;

    /**
     *
     * @var integer
     */
    public $number;

    /**
     *
     * @var integer
     */
    public $orderid;

    /**
     *
     * @var integer
     */
    public $orderdetailid;

    /**
     *
     * @var string
     */
    public $createdate;

    /**
     *
     * @var integer
     */
    public $warehousingnumber;

    /**
     *
     * @var integer
     */
    public $orderbrandid;

    /**
     *
     * @var integer
     */
    public $orderbranddetailid;

    /**
     *
     * @var integer
     */
    public $currencyid;

    /**
     *
     * @var double
     */
    public $cost;

    /**
     *
     * @var integer
     */
    public $costcurrency;

    /**
     *
     * @var double
     */
    public $factoryprice;

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
