<?php

namespace Asa\Erp;

/**
 * 订单明细表
 *
 * Class TbOrderdetails
 * @package Asa\Erp
 * @property int $id 主键id
 * @property int $orderid 订单id
 * @property int $sizecontentid 尺码id
 * @property int $number 数量
 * @property int $productid 产品id
 * @property int|null $currencyid 货币id
 * @property float|null $price 零售价
 * @property int|null $confirm_number 确认数量
 * @property int|null $companyid 公司id
 * @property null $createdate 创建时间
 * @property bool|null $status 状态
 * @property float|null $discount 折扣
 * @property int|null $shipping_number 已发货数量
 * @property int|null $brand_number 品牌订单数量
 * @property float|null $factoryprice 出厂价
 * @property float|null $wordprice 零售价
 * @property-read TbProduct|null $product 商品
 * @property-read TbSizecontent|null $sizecontent 商品尺码
 * @property-read TbOrder|null $order 订单
 */
class TbOrderdetails extends BaseModel
{
    /**
     * 初始化
     */
    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_orderdetails');

        // 订单详情-商品主表，一对多反向
        $this->belongsTo(
            'productid',
            TbProduct::class,
            'id',
            [
                'alias' => 'product',
            ]
        );

        // 订单详情-商品尺码表，一对多反向
        $this->belongsTo(
            'sizecontentid',
            TbSizecontent::class,
            'id',
            [
                'alias' => 'sizecontent',
            ]
        );

        // 订单详情-订单，一对多反向
        $this->belongsTo(
            'orderid',
            TbOrder::class,
            'id',
            [
                'alias' => 'order',
            ]
        );
    }
}
