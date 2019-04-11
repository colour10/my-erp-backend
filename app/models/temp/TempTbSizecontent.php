<?php

namespace Asa\Models\Temp;

use Asa\Erp\BaseModel;

/**
 * 商品尺码信息
 */
class TempTbSizecontent extends BaseModel
{
    public function initialize()
    {
        parent::initialize();
        $this->setSource('temp_tb_sizecontent');

        // 尺码详情-尺码组，一对多反向
        $this->belongsTo(
            'oldtopid',
            '\Asa\Models\Temp\TempTbSizetop',
            'oldid',
            [
                'alias' => 'sizetop'
            ]
        );
    }
}
