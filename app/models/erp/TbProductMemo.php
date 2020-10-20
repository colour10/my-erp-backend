<?php

namespace Asa\Erp;

/**
 * 商品描述
 *
 * Class TbProductMemo
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
 */
class TbProductMemo extends BaseModel
{
    /**
     * 初始化
     */
    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_product_memo');
    }

    /**
     * 验证规则
     *
     * @return array
     */
    public function getRules()
    {
        $factory = $this->getValidatorFactory();
        return [
            'name_cn' => [$factory->presenceOfMultiple('mingcheng'), $factory->uniqueness('mingcheng', false)],
            'name_en' => $factory->uniqueness('mingcheng'),
        ];
    }
}
