<?php

namespace Asa\Erp;

/**
 * 供应商-公司账号信息表
 * Class TbSupplierBank
 * @package Asa\Erp
 */
class TbSupplierBank extends BaseModel
{
    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_supplier_bank');
    }
}
