<?php

namespace Asa\Erp;

use Phalcon\Mvc\Model\Relation;

/**
 * 基础资料，商品尺寸表
 *
 * Class TbUlnarinch
 * @package Asa\Erp
 * @property int $id 主键id
 * @property string|null $name_cn 中文名称
 * @property string|null $name_en 英文名称
 * @property string|null $name_hk 粤语名称
 * @property string|null $name_fr 法语名称
 * @property string|null $name_it 意大利语名称
 * @property string|null $name_sp 西班牙语名称
 * @property string|null $name_de 德语名称
 * @property int|null $displayindex 排序
 * @property int|null $brandgroupchildid 子品类id
 * @property-read TbProduct $products 商品列表
 */
class TbUlnarinch extends BaseModel
{
    /**
     * 初始化
     */
    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_ulnarinch');

        // 商品尺寸表-商品表，一对多
        $this->hasMany(
            "id",
            TbProduct::class,
            "ulnarinch",
            [
                'alias'      => 'products',
                'foreignKey' => [
                    // 关联字段存在性验证
                    'action'  => Relation::ACTION_RESTRICT,
                    "message" => "/1003/商品尺寸已经使用，不能删除/",
                ],
            ]
        );
    }
}
