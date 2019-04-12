<?php

namespace Asa\Models\Temp;

use Asa\Erp\BaseModel;

/**
 * 基础资料，子品类表
 */
class TempTbBrandgroupchild extends BaseModel
{
    public function initialize()
    {
        parent::initialize();
        $this->setSource('temp_tb_brandgroupchild');

        // 子品类-品类，一对多反向
        $this->belongsTo(
            'oldbrandgroupid',
            '\Asa\Models\Temp\TempTbBrandgroup',
            'oldid',
            [
                'alias' => 'brandgroup'
            ]
        );

        // 子品类-尺码属性，一对多
        $this->hasMany(
            "oldtempid",
            "\Asa\Models\Temp\TempTbBrandgroupchildProperty",
            "oldtempid",
            [
                'alias' => 'brandgroupchildpropertys',
            ]
        );
    }
}
