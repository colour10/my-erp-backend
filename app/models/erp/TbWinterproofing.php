<?php

namespace Asa\Erp;

/**
 * 防寒指数表
 * Class TbWinterproofing
 * @package Asa\Erp
 */
class TbWinterproofing extends BaseModel
{
    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_winterproofing');
    }
}
