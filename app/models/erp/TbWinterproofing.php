<?php

namespace Asa\Erp;

/**
 * 防寒指数
 */
class TbWinterproofing extends BaseModel
{
    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_winterproofing');
    }
}
