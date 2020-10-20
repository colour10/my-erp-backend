<?php

namespace Asa\Erp;

/**
 * 发货单费用表
 *
 * Class TbShippingFee
 * @package Asa\Erp
 * @property int $id 主键id
 * @property int|null $shippingid 发货单id
 * @property int|null $currencyid 币种
 * @property float|null $amount 金额
 * @property int|null $makestaff 添加人
 * @property null $maketime 添加时间
 * @property int|null $companyid 公司id
 * @property int|null $feenameid 费用名称
 * @property string|null $memo 备注
 * @property float|null $exchangerate 汇率
 * @property-read TbFeename|null $feename 费用表
 */
class TbShippingFee extends BaseModel
{
    /**
     * 初始化
     */
    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_shipping_fee');

        // 发货单费用表-费用表，一对多反向
        $this->belongsTo(
            'feenameid',
            TbFeename::class,
            'id',
            [
                'alias' => 'feename',
            ]
        );
    }
}
