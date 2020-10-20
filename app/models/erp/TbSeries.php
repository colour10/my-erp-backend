<?php

namespace Asa\Erp;

use Phalcon\Mvc\Model\Relation;

/**
 * 品牌系列，品牌相关数据
 *
 * Class TbSeries
 * @package Asa\Erp
 * @property int $id 主键id
 * @property string|null $name_cn 中文名称
 * @property string|null $name_en 英文名称
 * @property string|null $name_hk 粤语名称
 * @property string|null $name_fr 法语名称
 * @property string|null $name_it 意大利语名称
 * @property string|null $name_sp 西班牙语名称
 * @property string|null $name_de 德语名称
 * @property string|null $code 中文代码名称
 * @property int|null $brandid 品牌主键id
 * @property int|null $displayindex 排序序号
 * @property int|null $companyid 公司id
 * @property-read TbProduct|null $products 商品表
 */
class TbSeries extends BaseModel
{
    /**
     * 初始化
     */
    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_series');

        // 品牌系列-商品表，一对多
        $this->hasMany(
            "id",
            TbProduct::class,
            "series",
            [
                'alias'      => 'products',
                'foreignKey' => [
                    // 关联字段存在性验证
                    'action'  => Relation::ACTION_RESTRICT,
                    "message" => "/1003/系列已经使用，不能删除/",
                ],
            ]
        );
    }
}
