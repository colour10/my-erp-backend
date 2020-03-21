<?php

namespace Asa\Erp;

/**
 * 海关销售单位表，但是目前数据库暂时没有这张表
 * Class TbCustomsUnit
 * @package Asa\Erp
 */
class TbCustomsUnit extends BaseModel
{
    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_customs_unit');
    }
}
