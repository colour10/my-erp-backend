<?php

namespace Asa\Models\Temp;

use Asa\Erp\BaseModel;

/**
 * 基础资料，子系列表
 */
class TempTbSeries2 extends BaseModel
{
    public function initialize()
    {
        parent::initialize();
        $this->setSource('temp_tb_series2');

        // 子品类-品类，一对多反向
        $this->belongsTo(
            'oldseriesid',
            '\Asa\Models\Temp\TempTbSeries',
            'oldid',
            [
                'alias' => 'serie'
            ]
        );
    }
}
