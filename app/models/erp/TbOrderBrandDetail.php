<?php

namespace Asa\Erp;

/**
 * 品牌订单明细
 *
 * Class TbOrderBrandDetail
 * @package Asa\Erp
 * @property int $id 主键id
 * @property int $orderbrandid 品牌订单id
 * @property int $sizecontentid 尺码id
 * @property int $number 数量
 * @property int $productid 产品id
 * @property int $confirm_number 确认数量
 * @property int $companyid 公司id
 * @property null $createdate 创建时间
 * @property int $orderdetailid 订单明细id
 * @property int $orderid 订单id
 * @property int $shipping_number 发货数量
 * @property float|null $discount 折扣率
 * @property float|null $factoryprice 出厂价
 * @property int|null $currencyid 货币单位
 * @property float|null $wordprice 零售价
 */
class TbOrderBrandDetail extends BaseModel
{
    /**
     * 初始化
     */
    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_order_brand_detail');
    }
}
