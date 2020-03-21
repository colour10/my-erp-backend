<?php

namespace Asa\Erp;

/**
 * 关系单位信息，供货商表
 */
class TbSupplier extends BaseModel
{
    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_supplier');
    }
}
