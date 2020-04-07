<?php

namespace Asa\Erp;

/**
 * 供应商，联系人信息
 * Class TbSupplierLinkman
 * @package Asa\Erp
 */
class TbSupplierLinkman extends BaseModel
{
    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_supplier_linkman');
    }
}
