<?php

namespace Asa\Erp;

/**
 * 包装代码表, 但是目前数据库暂时没有这张表
 * Class TbCustomsWrap
 * @package Asa\Erp
 */
class TbCustomsWrap extends BaseModel
{
    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_customs_wrap');
    }
}
