<?php

namespace Asa\Models\Temp;

use Asa\Erp\BaseModel;

/**
 * 基础资料，品类表
 */
class TempTbBrandgroup extends BaseModel
{
    public function initialize()
    {
        parent::initialize();
        $this->setSource('temp_tb_brandgroup');
    }
}
