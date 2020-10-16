<?php

namespace Asa\Erp;

use Phalcon\Mvc\Model\Relation;

/**
 * 尺码组
 *
 * Class TbSizetop
 * @package Asa\Erp
 * @property int $id 主键id
 * @property string|null $name_cn 中文名称
 * @property string|null $name_en 英文名称
 * @property string|null $name_hk 粤语名称
 * @property string|null $name_fr 法语名称
 * @property string|null $name_it 意大利语名称
 * @property string|null $name_sp 西班牙语名称
 * @property string|null $name_de 德语名称
 * @property string|null $code 编码
 * @property int|null $displayindex 排序
 * @property null $created_at 创建时间
 * @property null $updated_at 更新时间
 * @property-read TbSizecontent $sizecontents 尺码明细
 * @property-read TbProduct $products 商品列表
 */
class TbSizetop extends BaseModel
{
    /**
     * 初始化
     */
    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_sizetop');

        // 尺码组-尺码详情，一对多
        $this->hasMany(
            "id",
            TbSizecontent::class,
            "topid",
            [
                'alias'      => 'sizecontents',
                'foreignKey' => [
                    // 关联字段存在性验证
                    'action'  => Relation::ACTION_RESTRICT,
                    "message" => "/1003/尺码组已经使用，不能删除/",
                ],
            ]
        );

        // 尺码组-商品表，一对多
        $this->hasMany(
            "id",
            TbProduct::class,
            "sizetopid",
            [
                'alias'      => 'products',
                'foreignKey' => [
                    // 关联字段存在性验证
                    'action'  => Relation::ACTION_RESTRICT,
                    "message" => "/1003/尺码组已经使用，不能删除/",
                ],
            ]
        );
    }

    /**
     * 验证信息
     *
     * @return array
     */
    public function getRules()
    {
        $factory = $this->getValidatorFactory();
        return [
            'name_cn'      => $factory->presenceOf('jiancheng'),
            'name_en'      => $factory->presenceOf('mingcheng'),
            'displayindex' => [$factory->presenceOf('paixu')],
        ];
    }
}
