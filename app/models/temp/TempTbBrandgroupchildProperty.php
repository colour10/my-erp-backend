<?php

namespace Asa\Models\Temp;

use Asa\Erp\BaseModel;

/**
 * 基础资料，尺码规格子表
 */
class TempTbBrandgroupchildProperty extends BaseModel
{
    public function initialize()
    {
        parent::initialize();
        $this->setSource('temp_tb_brandgroupchild_property');

        // 尺码规格子表-子品类表，关联字段一对一
        $this->hasOne(
            'oldtempid',
            '\Asa\Models\Temp\TempTbBrandgroupchild',
            'oldtempid',
            [
                'alias' => 'brandgroupchild'
            ]
        );
    }
}
