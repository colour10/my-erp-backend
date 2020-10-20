<?php

namespace Asa\Erp;

use Phalcon\Mvc\Model\Relation;

/**
 * 销售属性表
 *
 * Class TbSaleType
 * @package Asa\Erp
 * @property int $id 主键id
 * @property int $colortemplateid 色系id
 * @property string|null $name_cn 中文名称
 * @property string|null $name_en 英文名称
 * @property string|null $name_hk 粤语名称
 * @property string|null $name_fr 法语名称
 * @property string|null $name_it 意大利语名称
 * @property string|null $name_sp 西班牙语名称
 * @property string|null $name_de 德语名称
 * @property int|null $displayindex 排序
 * @property-read TbProduct|null $products 商品列表
 */
class TbSaleType extends BaseModel
{
    /**
     * 初始化
     */
    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_sale_type');

        // 销售属性表-商品表，一对多
        $this->hasMany(
            "id",
            TbProduct::class,
            "saletypeid",
            [
                'alias'      => 'products',
                'foreignKey' => [
                    // 关联字段存在性验证
                    'action'  => Relation::ACTION_RESTRICT,
                    "message" => "/1003/销售属性已经使用，不能删除/",
                ],
            ]
        );
    }
}
