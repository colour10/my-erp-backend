<?php

namespace Asa\Erp;

use Phalcon\Mvc\Model\Relation;

/**
 * 基础资料，材质备注表
 *
 * Class TbMaterialnote
 * @package Asa\Erp
 * @property int $id 主键id
 * @property string|null $content_cn 中文名称
 * @property string|null $content_en 英文名称
 * @property string|null $content_hk 粤语名称
 * @property string|null $content_fr 法语名称
 * @property string|null $content_it 意大利语名称
 * @property string|null $content_sp 西班牙语名称
 * @property string|null $content_de 德语名称
 * @property int|null $displayindex 排序
 * @property string|null $brandgroupids 品类列表
 * @property-read TbProductMaterial $productMaterial 材质备注对应的商品列表
 */
class TbMaterialnote extends BaseModel
{
    /**
     * 初始化
     */
    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_materialnote');

        // 材质备注-材质与材质备注关联表，一对多
        $this->hasMany(
            "id",
            TbProductMaterial::class,
            "materialnoteid",
            [
                'alias'      => 'productMaterial',
                'foreignKey' => [
                    // 关联字段存在性验证
                    'action'  => Relation::ACTION_RESTRICT,
                    "message" => "/1003/材质备注已经使用，不能删除/",
                ],
            ]
        );
    }
}
