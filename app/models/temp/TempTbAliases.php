<?php

namespace Asa\Models\Temp;

use Asa\Erp\BaseModel;

/**
 * 基础资料，别名表
 */
class TempTbAliases extends BaseModel
{
    public function initialize()
    {
        parent::initialize();
        $this->setSource('temp_tb_aliases');

        // 别名表-品牌表，一对多反向
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
