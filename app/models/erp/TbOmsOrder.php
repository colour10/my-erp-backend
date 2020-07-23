<?php

namespace Asa\Erp;

/**
 * 来自 oms 的订单表
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
