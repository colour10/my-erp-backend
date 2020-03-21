<?php

namespace Asa\Erp;

/**
 *
 */
class TbSupplierBank extends BaseModel
{
    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_supplier_bank');
    }
}
