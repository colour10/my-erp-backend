<?php

namespace Asa\Models\Temp;

use Asa\Erp\BaseModel;

/**
 * 商品尺码信息
 */
class TempTbSizetop extends BaseModel
{
    public function initialize()
    {
        parent::initialize();
        $this->setSource('temp_tb_sizetop');
    }
}
