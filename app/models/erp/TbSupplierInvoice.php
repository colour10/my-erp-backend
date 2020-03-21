<?php

namespace Asa\Erp;

/**
 * 基公司发票管理
 */
class TbSupplierInvoice extends BaseModel
{
    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_supplier_invoice');
    }
}
