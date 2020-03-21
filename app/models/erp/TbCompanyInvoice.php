<?php

namespace Asa\Erp;

/**
 * 基公司发票管理
 */
class TbCompanyInvoice extends BaseModel
{
    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_company_invoice');
    }
}
