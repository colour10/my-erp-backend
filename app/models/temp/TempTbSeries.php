<?php

namespace Asa\Models\Temp;

use Asa\Erp\BaseModel;

/**
 * 基础资料，系列表
 */
class TempTbSeries extends BaseModel
{
    public function initialize()
    {
        parent::initialize();
        $this->setSource('temp_tb_series');

        // 系列-品牌表，一对多反向
        $this->belongsTo(
            'oldbrandid',
            '\Asa\Models\Temp\TempTbBrand',
            'oldid',
            [
                'alias' => 'brand'
            ]
        );
    }
}
