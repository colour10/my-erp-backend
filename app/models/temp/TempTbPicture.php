<?php

namespace Asa\Models\Temp;

use Asa\Erp\BaseModel;

/**
 * 测试图片表
 */
class TempTbPicture extends BaseModel
{
    public function initialize()
    {
        parent::initialize();
        $this->setSource('temp_tb_picture');
    }
}
