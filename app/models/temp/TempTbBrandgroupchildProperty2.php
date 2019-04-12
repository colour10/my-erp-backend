<?php

namespace Asa\Models\Temp;

use Asa\Erp\BaseModel;

/**
 * 基础资料，尺码规格子表(根据temp_tb_brandgroupchild_property和temp_tb_brandgroupchild重新生成的新表)
 */
class TempTbBrandgroupchildProperty2 extends BaseModel
{
    public function initialize()
    {
        parent::initialize();
        $this->setSource('temp_tb_brandgroupchild_property2');
    }
}
