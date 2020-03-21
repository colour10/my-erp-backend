<?php

namespace Asa\Erp;

/**
 * 收货人信息
 */
class TbSupplierAddress extends BaseModel
{
    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_supplier_address');
    }
}
