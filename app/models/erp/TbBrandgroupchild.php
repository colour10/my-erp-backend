<?php

namespace Asa\Erp;

use Phalcon\Mvc\Model\Relation;

/**
 * 子品类
 *
 * Class TbBrandgroupchild
 * @package Asa\Erp
 * @property int $id 主键id
 * @property string|null $name_cn 中文名称
 * @property string|null $name_en 英文名称
 * @property string|null $name_hk 粤语名称
 * @property string|null $name_fr 法语名称
 * @property string|null $name_it 意大利语名称
 * @property string|null $name_sp 西班牙语名称
 * @property string|null $name_de 德语名称
 * @property int|null $brandgroupid 品类id
 * @property int|null $displayindex 序号
 * @property string|null $diagram 示意图
 * @property-read TbBrandgroup|null $brandgroup 品类
 * @property-read TbProduct|null $products 商品
 * @property-read TbBrandgroupchildProperty|null $brandgroupchildProperties 商品尺寸
 * @property-read TbProductMemoBrandgroupchild|null $productMemoIds 子品类和商品描述的关联表
 */
class TbBrandgroupchild extends BaseModel
{
    /**
     * 初始化
     */
    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_brandgroupchild');

        // 子品类-品类，一对多反向
        $this->belongsTo(
            'brandgroupid',
            TbBrandgroup::class,
            'id',
            [
                'alias' => 'brandgroup',
            ]
        );

        // 子品类-商品，一对多
        $this->hasMany(
            "id",
            TbProduct::class,
            "childbrand",
            [
                'alias'      => 'products',
                'foreignKey' => [
                    // 关联字段存在性验证
                    'action'  => Relation::ACTION_RESTRICT,
                    "message" => "/1003/子类已经在商品信息中使用/",
                ],
            ]
        );

        // 子品类-商品尺寸，一对多
        $this->hasMany(
            "id",
            TbBrandgroupchildProperty::class,
            "brandgroupchildid",
            [
                'alias'      => 'brandgroupchildProperties',
                'foreignKey' => [
                    // 关联字段存在性验证
                    'action'  => Relation::ACTION_RESTRICT,
                    "message" => "/1003/子类已经设置了属性/",
                ],
            ]
        );

        // 子品类和商品描述的关联表，一对多的关系
        $this->hasMany(
            "id",
            TbProductMemoBrandgroupchild::class,
            "brandgroupchild_id",
            [
                'alias' => 'productMemoIds',
            ]
        );
    }

    /**
     * 验证规则
     *
     * @return array
     */
    public function getRules()
    {
        return [
            'name_cn'      => $this->getValidatorFactory()->presenceOfMultiple('zileimingcheng'),
            'brandgroupid' => $this->getValidatorFactory()->tableid('pinlei'),
            'displayindex' => $this->getValidatorFactory()->digit('xuhao'),
        ];
    }

    /**
     * 获取子品类关联的商品描述id
     */
    public function getProductMemoIds()
    {
        $productMemoIds = [];
        foreach ($this->productMemoIds as $item) {
            $productMemoIds[] = $item->memo_id;
        }

        return $productMemoIds;
    }
}
