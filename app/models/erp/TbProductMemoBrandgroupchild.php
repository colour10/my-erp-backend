<?php

namespace Asa\Erp;

/**
 * 商品描述关联子品类
 *
 * Class TbProductMemoBrandgroupchild
 * @package Asa\Erp
 * @property int $id 主键id
 * @property int $memo_id 商品描述id
 * @property int $brandgroupchild_id 子品类id
 * @property null $created_at
 * @property null $updated_at
 */
class TbProductMemoBrandgroupchild extends BaseModel
{
    /**
     * 初始化
     */
    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_product_memo_brandgroupchild');
    }
}
