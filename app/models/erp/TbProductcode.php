<?php

namespace Asa\Erp;

/**
 * 商品货号表
 * Class TbProductcode
 * @package Asa\Erp
 */
class TbProductcode extends BaseModel
{
    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_productcode');
    }
}
