<?php

namespace Asa\Erp;

/**
 * 对账单表
 *
 * Class TbBill
 * @package Asa\Erp
 * @property int $id 主键ID
 * @property string|null $billno 编号
 * @property int|null $companyid 公司ID
 * @property null $createtime 创建时间
 * @property int|null $createstaff 创建人
 * @property string|null $memo 备注
 * @property bool|null $status 1=未回款；2=部分回款；3=已回款
 * @property string|null $out_billno 外部对账单号
 * @property int|null $currencyid 币种ID
 * @property float|null $amount_origin 原始金额
 * @property float|null $amount 金额
 * @property int|null $supplierid 收付费单位
 * @property int|null $invoiceid 发票抬头
 * @property int|null $billtype 收/付费:1=收；2=付
 */
class TbBill extends BaseModel
{
    // 对账单的三种状态
    // 1、未回款
    const STATUS_NOT_PAYMENT = 1;
    // 2、部分回款
    const STATUS_PART_PAYMENT = 2;
    // 3、已回款
    const STATUS_ALL_PAYMENT = 3;

    /**
     * 初始化
     */
    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_bill');
    }
}
