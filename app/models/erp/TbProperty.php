<?php
namespace Asa\Erp;

/**
 * 属性定义表
 */
class TbProperty extends BaseModel
{
    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_property');
    }
}
