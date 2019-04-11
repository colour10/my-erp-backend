<?php

namespace Asa\Models\Temp;

use Asa\Erp\BaseModel;

/**
 * 基础资料，系列表
 */
class TempTbBrand extends BaseModel
{
    public function initialize()
    {
        parent::initialize();
        $this->setSource('temp_tb_brand');

        // 品牌表-国家表，一对多反向
        $this->belongsTo(
            'oldcountryid',
            '\Asa\Models\Temp\TempTbCountry',
            'oldid',
            [
                'alias' => 'country'
            ]
        );
    }
}
