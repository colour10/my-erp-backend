<?php

namespace Asa\Erp;

use Phalcon\Mvc\Model\Relation;

/**
 * 基础资料，材质表
 *
 * Class TbMaterial
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
 * @property string|null $materialnoteids 材质备注列表
 * @property-read TbProductMaterial $productMaterial 商品材质表
 */
class TbMaterial extends BaseModel
{
    /**
     * 初始化
     */
    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_material');

        // 材质-商品材质表，一对多
        $this->hasMany(
            "id",
            TbProductMaterial::class,
            "materialid",
            [
                'alias'      => 'productMaterial',
                'foreignKey' => [
                    // 关联字段存在性验证
                    'action'  => Relation::ACTION_RESTRICT,
                    "message" => "/1003/材质已经使用，不能删除/",
                ],
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
            'name_cn' => $this->getValidatorFactory()->presenceOfMultiple('mingcheng')
            //'code' => $this->getValidatorFactory()->presenceOf('caizhidaima')
        ];
    }

    /**
     * 获取材质对应的材质备注
     */
    public function getMaterialnotes()
    {
        if ($this->materialnoteids) {
            $rows = TbMaterialnote::find([
                sprintf("id IN (%s)", $this->materialnoteids),
            ]);

            $lang = $this->getDI()->get("session")->get("language");
            $array = [];
            foreach ($rows as $row) {
                $array[] = $row->{'content_' . $lang};
            }

            return implode(',', $array);
        } else {
            return '';
        }
    }
}
