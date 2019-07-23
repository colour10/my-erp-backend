<?php
namespace Asa\Erp;

/**
 * 商品货号表
 */
class TbProductcode extends BaseModel
{
    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_productcode');
    }
}
