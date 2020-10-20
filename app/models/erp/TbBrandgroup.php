<?php

namespace Asa\Erp;

use Phalcon\Mvc\Model\Relation;

/**
 * 基础资料：品类表
 *
 * Class TbBrandgroup
 * @package Asa\Erp
 * @property int $id 主键id
 * @property int|null $displayindex 排序序号
 * @property string|null $name_cn 中文名称
 * @property string|null $name_en 英文名称
 * @property string|null $name_hk 粤语名称
 * @property string|null $name_fr 法语名称
 * @property string|null $name_it 意大利语名称
 * @property string|null $name_sp 西班牙语名称
 * @property string|null $name_de 德语名称
 * @property-read TbBrandgroupchild|null $brandgroupchilds 子品类
 */
class TbBrandgroup extends BaseModel
{
    /**
     * 初始化
     */
    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_brandgroup');

        // 品类-子品类，一对多
        $this->hasMany(
            "id",
            TbBrandgroupchild::class,
            "brandgroupid",
            [
                'alias'      => 'brandgroupchilds',
                'foreignKey' => [
                    // 关联字段存在性验证
                    'action'  => Relation::ACTION_RESTRICT,
                    "message" => "/1003/品类数据已经使用，不允许删除/",
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
            'name_cn'      => $this->getValidatorFactory()->presenceOfMultiple('pinleimingcheng'),
            'displayindex' => $this->getValidatorFactory()->digit('xuhao'),
        ];
    }
}
