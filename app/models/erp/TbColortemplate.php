<?php

namespace Asa\Erp;

use Phalcon\Mvc\Model\Relation;

/**
 * 基础资料，ASA颜色模板表
 *
 * Class TbColortemplate
 * @package Asa\Erp
 * @property int $id 主键id
 * @property string|null $name_cn 中文名称
 * @property string|null $name_en 英文名称
 * @property string|null $name_hk 粤语名称
 * @property string|null $name_fr 法语名称
 * @property string|null $name_it 意大利语名称
 * @property string|null $name_sp 西班牙语名称
 * @property string|null $name_de 德语名称
 * @property string|null $picture 图片地址
 * @property string|null $code 编码
 * @property int $color_system_id 色系id
 * @property null $created_at 创建时间
 * @property null $updated_at 更新时间
 * @property-read TbProduct $products 商品列表
 * @property-read TbSaleType $saleTypes 销售类型
 * @property-read TbColorSystem $colorsystem 色系
 */
class TbColortemplate extends BaseModel
{
    /**
     * 初始化
     */
    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_colortemplate');

        // 颜色-产品，一对多
        $this->hasMany(
            "id",
            TbProduct::class,
            "brandcolor",
            [
                'alias'      => 'products',
                'foreignKey' => [
                    // 关联字段存在性验证
                    'action'  => Relation::ACTION_RESTRICT,
                    "message" => "/1003/色系已经使用，不能删除/",
                ],
            ]
        );

        // 颜色-销售类型，一对多
        $this->hasMany(
            "id",
            TbSaleType::class,
            "colortemplateid",
            [
                'alias'      => 'saleTypes',
                'foreignKey' => [
                    // 关联字段存在性验证
                    'action'  => Relation::ACTION_RESTRICT,
                    "message" => "/1003/色系已经使用，不能删除/",
                ],
            ]
        );

        // 颜色-色系，一对多反向
        $this->belongsTo(
            'color_system_id',
            TbColorSystem::class,
            'id',
            [
                'alias' => 'colorsystem',
            ]
        );
    }
}
