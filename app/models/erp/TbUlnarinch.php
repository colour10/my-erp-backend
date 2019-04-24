<?php
namespace Asa\Erp;

/**
 * 基础资料，商品尺寸表
 */
class TbUlnarinch extends BaseModel
{
    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_ulnarinch');
    }
}
