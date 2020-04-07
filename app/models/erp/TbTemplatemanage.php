<?php

namespace Asa\Erp;

/**
 * 基础资料，商品尺码描述子表
 * Class TbTemplatemanage
 * @package Asa\Erp
 */
class TbTemplatemanage extends BaseModel
{
    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_templatemanage');
    }
}
