<?php

namespace Asa\Erp;

/**
 * 来自 OMS 的订单表
 *
 * Class TbOmsOrder
 * @package Asa\Erp
 * @property int $id 主键ID
 * @property int|null $productid 产品id
 * @property string|null $orderNo 订单编号
 * @property string|null $productName 产品名称
 * @property float $orderTotal 订单总金额
 * @property string|null $consignee 收货人姓名
 * @property string|null $consignee_telephone 收货人电话
 * @property string|null $consignee_address 收货人地址
 * @property string|null $color 颜色名称
 * @property string|null $sizecontent 尺码名称
 * @property int $orderStatus 订单状态id 等待处理:10，处理中:20，完成：30，取消：40
 * @property int $paymentStatus 支付状态id 未支付：10，支付处理中：20，已支付：30，部分支付35，退款：40，取消：50
 * @property int $shippingStatus 发货状态
 * @property string|null $shipmentCopCode 快递公司代码
 * @property string|null $trackingNumber 快递单号
 * @property bool|null $isRefuse 是否拒绝发货 0：正常发货 1：拒绝发货
 * @property bool|null $isNoExpress 是否无需物流 0：正常发货 1：自行送货
 * @property string|null $note 备注，拒绝发货和无需物流，必传此字段，说明拒绝原因或发货方式
 * @property string|null $extra 订单详情，json格式
 * @property null $created_at 创建时间
 * @property null $updated_at 更新时间
 */
class TbOmsOrder extends BaseModel
{
    // 初始化
    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_oms_order');
    }

    // 状态列表
    // 1.订单状态
    // 1)等待处理
    const STATUS_ORDER_PENDING = 10;
    // 2)处理中
    const STATUS_ORDER_PROCESSING = 20;
    // 3)完成
    const STATUS_ORDER_FINISH = 30;
    // 4)取消
    const STATUS_ORDER_CANCEL = 40;

    // 2.付款状态
    // 1)未付款
    const STATUS_PAYMENT_UNPAID = 10;
    // 2)支付处理中
    const STATUS_PAYMENT_PROCESSING = 20;
    // 3)已支付
    const STATUS_PAYMENT_PAID = 30;
    // 4)部分支付
    const STATUS_PAYMENT_PARTPAID = 35;
    // 5)退款
    const STATUS_PAYMENT_REFUND = 40;
    // 6)取消
    const STATUS_PAYMENT_CANCEL = 50;

    // 3.是否拒绝发货
    // 1)正常发货
    const STATUS_DONOT_REFUSE = 0;
    // 2)拒绝发货
    const STATUS_DO_REFUSE = 1;

    // 4.是否无需物流
    // 1)正常发货
    const STATUS_EXPRESS_REQUIRED = 0;
    // 2)自行送货
    const STATUS_NOEXPRESS = 1;
}
