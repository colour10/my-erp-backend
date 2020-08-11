<?php

namespace Asa\Erp;

/**
 * 商品描述关联子品类
 *
 * Class TbProductMemoBrandgroupchild
 * @package Asa\Erp
 */
class TbProductMemoBrandgroupchild extends BaseModel
{
    /**
     *
     * @var integer
     */
    public $memo_id;

    /**
     *
     * @var integer
     */
    public $brandgroupchild_id;

    /**
     *
     * @var string
     */
    public $created_at;

    /**
     *
     * @var string
     */
    public $updated_at;

    /**
     * 初始化
     */
    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_product_memo_barndgroupchild');
    }
}
