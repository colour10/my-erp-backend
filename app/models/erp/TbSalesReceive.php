<?php

namespace Asa\Erp;

/**
 * 销售单收款信息表
 *
 * Class TbSalesReceive
 * @package Asa\Erp
 * @property int $id 主键id
 * @property int|null $salesid 销售单id
 * @property int|null $currency 币种
 * @property float|null $amount 金额
 * @property int|null $makestaff 添加人
 * @property null $maketime 添加时间
 * @property int|null $confirmstaff 收款确认人
 * @property null $confirmtime 收款确认时间
 * @property string|null $paymentdate 收款日期
 * @property int|null $companyid 公司id
 * @property int|null $status 收款状态：0=未收到；1=已收到
 * @property int|null $payment_type 收款类型：1=定金；2=货款
 * @property string|null $memo 备注
 * @property int|null $billno 对账单id
 * @property int|null $payment_way 付款方式
 * @property int|null $billid 对账单id
 * @property int|null $paymentwayid 付款方式
 * @property-read TbSales|null $sales 销售单
 */
class TbSalesReceive extends BaseModel
{
    /**
     * 初始化
     */
    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_sales_receive');

        // 收款信息-销售单，一对多反向
        $this->belongsTo(
            'salesid',
            TbSales::class,
            'id',
            [
                'alias' => 'sales',
            ]
        );
    }
}
