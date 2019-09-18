<?php
namespace Asa\Erp;

/**
 * 包装代码表
 */
class TbCustomsWrap extends BaseModel
{
    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_customs_wrap');
    }
}
