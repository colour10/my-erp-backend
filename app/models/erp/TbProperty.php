<?php

namespace Asa\Erp;

use Phalcon\Mvc\Model\Relation;

/**
 * 属性定义表
 *
 * Class TbProperty
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
 * @property-read TbBrandgroupchildProperty|null $brandgroupchildproperties 商品尺寸
 */
class TbProperty extends BaseModel
{
    /**
     * 初始化
     */
    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_property');

        // 属性表-商品尺寸表，一对多
        $this->hasMany(
            "id",
            TbBrandgroupchildProperty::class,
            "propertyid",
            [
                'alias'      => 'brandgroupchildproperties',
                'foreignKey' => [
                    // 关联字段存在性验证
                    'action'  => Relation::ACTION_RESTRICT,
                    "message" => "/1003/属性已经使用，不能删除/",
                ],
            ]
        );
    }
}
