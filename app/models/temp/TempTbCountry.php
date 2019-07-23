<?php

namespace Asa\Models\Temp;

use Asa\Erp\BaseModel;

/**
 * 基础资料，国家及地区信息表
 */
class TempTbCountry extends BaseModel
{
    public function initialize()
    {
        parent::initialize();
        $this->setSource('temp_tb_country');
    }
}
