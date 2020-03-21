<?php

namespace Asa\Erp;

/**
 * 基础资料，颜色色系表
 */
class TbColorSystem extends BaseModel
{
    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_color_system');
    }
}
