<?php

namespace Asa\Erp;

/**
 * 基础资料，国家及地区信息表
 */
class TbCountry extends BaseModel
{
    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_country');
    }
}
