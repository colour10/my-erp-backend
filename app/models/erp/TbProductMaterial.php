<?php

namespace Asa\Erp;

/**
 * 商品材质表
 *
 * Class TbProductMaterial
 * @package Asa\Erp
 */
class TbProductMaterial extends BaseModel
{
    /**
     *
     * @var integer
     */
    public $id;

    /**
     *
     * @var integer
     */
    public $productid;

    /**
     *
     * @var integer
     */
    public $percent;

    /**
     *
     * @var integer
     */
    public $materialid;

    /**
     *
     * @var integer
     */
    public $materialnoteid;

    /**
     * 初始化
     */
    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_product_material');
    }
}
