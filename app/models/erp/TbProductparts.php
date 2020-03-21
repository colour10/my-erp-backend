<?php

namespace Asa\Erp;

/**
 * 附带配件
 * Class TbProductparts
 * @package Asa\Erp
 */
class TbProductparts extends BaseModel
{
    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_productparts');
    }
}
        