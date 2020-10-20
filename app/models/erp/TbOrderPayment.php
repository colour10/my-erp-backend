<?php

namespace Asa\Erp;

/**
 * 订单付款信息表
 *
 * Class TbOrderPayment
 * @package Asa\Erp
 * @property int $id 主键id
 * @property int|null $shippingid 发货单id
 * @property int|null $currency 币种
 * @property float|null $amount 金额
 * @property int|null $makestaff 添加人
 * @property null $maketime 添加时间
 * @property int|null $confirmstaff 付款确认人
 * @property null $confirmtime 付款确认时间
 * @property string|null $paymentdate 付款日期
 * @property int|null $companyid 公司id
 * @property int|null $status 付款状态：0=未支付；1=已支付
 * @property int|null $payment_type 收款类型：1=定金；2=货款
 * @property string|null $memo 备注
 */
class TbOrderPayment extends BaseModel
{
    // 添加枚举
    // 付款状态
    // 未付款
    const STATUS_UNPAID = 0;
    // 已付款
    const STATUS_PAID = 1;

    // 付款类型
    // 定金
    const TYPE_DEPOSIT = 1;
    // 货款
    const TYPE_GOODS = 2;

    /**
     * 初始化
     */
    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_order_payment');
    }
}
