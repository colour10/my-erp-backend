<?php

namespace Asa\Erp;

/**
 * 基公司发票管理
 *
 * Class TbSupplierInvoice
 * @package Asa\Erp
 * @property int $id 主键id
 * @property string|null $name 单位名
 * @property string|null $address 地址
 * @property string|null $telephone 电话
 * @property string|null $bank 开户行
 * @property string|null $bank_account 银行账号
 * @property int|null $supplierid 供应商id
 * @property int|null $companyid 公司id
 * @property string|null $tax_number 税号
 */
class TbSupplierInvoice extends BaseModel
{
    /**
     * 初始化
     */
    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_supplier_invoice');
    }
}
