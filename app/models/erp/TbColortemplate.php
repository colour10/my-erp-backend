<?php

namespace Asa\Erp;


/**
 * 基础资料，ASA颜色模板表
 */
class TbColortemplate extends BaseModel
{
    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_colortemplate');
    }
}
