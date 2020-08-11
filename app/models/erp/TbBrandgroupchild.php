<?php

namespace Asa\Erp;

use Phalcon\Mvc\Model\Relation;

/**
 * 子品类
 * Class TbBrandgroupchild
 * @package Asa\Erp
 */
class TbBrandgroupchild extends BaseModel
{
    /**
     *
     * @var integer
     */
    public $id;

    /**
     *
     * @var string
     */
    public $name_cn;

    /**
     *
     * @var string
     */
    public $name_en;

    /**
     *
     * @var string
     */
    public $name_hk;

    /**
     *
     * @var string
     */
    public $name_fr;

    /**
     *
     * @var string
     */
    public $name_it;

    /**
     *
     * @var string
     */
    public $name_sp;

    /**
     *
     * @var string
     */
    public $name_de;

    /**
     *
     * @var integer
     */
    public $brandgroupid;

    /**
     *
     * @var integer
     */
    public $displayindex;

    /**
     *
     * @var string
     */
    public $diagram;

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

        // 子品类-商品，一对多
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
