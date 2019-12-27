<?php
namespace Asa\Erp;

/**
 * 商品描述关联子品类
 */
class TbProductMemoBrandgroupchild extends BaseModel
{
    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_product_memo_barndgroupchild');
    }
}
