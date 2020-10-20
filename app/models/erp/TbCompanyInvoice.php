<?php

namespace Asa\Erp;

/**
 * 基公司发票管理
 *
 * Class TbCompanyInvoice
 * @package Asa\Erp
 * @property int $id 主键id
 * @property string|null $name 名称
 * @property string|null $address 地址
 * @property string|null $telephone 电话
 * @property string|null $bank 银行
 * @property string|null $bank_account 银行账户
 * @property int|null $companyid 公司id
 */
class TbCompanyInvoice extends BaseModel
{
    /**
     * 初始化
     */
    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_company_invoice');
    }
}
