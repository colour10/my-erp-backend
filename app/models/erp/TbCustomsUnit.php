<?php
namespace Asa\Erp;

/**
 * 海关销售单位表
 */
class TbCustomsUnit extends BaseModel
{
    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_customs_unit');
    }
}
