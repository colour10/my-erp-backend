<?php
namespace Asa\Erp;

/**
 * 
 */
class TbProductPrice extends BaseModel
{
    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_product_price');
    }
}
