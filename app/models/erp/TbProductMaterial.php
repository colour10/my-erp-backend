<?php

namespace Asa\Erp;

/**
 * 商品材质表
 *
 * Class TbProductMaterial
 * @package Asa\Erp
 * @property int $id 主键id
 * @property int|null $productid 商品id
 * @property int|null $percent 百分比
 * @property int|null $materialid 材质id
 * @property int|null $materialnoteid 材质备注id
 * @property null $created_at 创建时间
 * @property null $updated_at 更新时间
 */
class TbProductMaterial extends BaseModel
{
    /**
     * 初始化
     */
    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_product_material');
    }
}
