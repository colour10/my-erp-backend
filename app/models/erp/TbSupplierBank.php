<?php

namespace Asa\Erp;

/**
 * 供应商-公司账号信息表
 *
 * Class TbSupplierBank
 * @package Asa\Erp
 * @property int $id 主键id
 * @property int|null $supplierid 供应商
 * @property int|null $companyid 公司id
 * @property string|null $name 账户名称
 * @property string|null $address 地址
 * @property string|null $bank_name 银行名称
 * @property string|null $bank_address 银行地址
 * @property string|null $bank_depart 分行名称
 * @property string|null $account 银行账号
 * @property string|null $bank_code 银行国际码
 * @property int|null $currency 币种
 */
class TbSupplierBank extends BaseModel
{
    /**
     * 初始化
     */
    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_supplier_bank');
    }
}
