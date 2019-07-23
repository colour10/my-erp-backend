<?php
namespace Asa\Erp;

/**
 * 商品条目表
 */
class TbGoods extends BaseModel
{
    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_goods');
    }
}
