<?php

namespace Asa\Erp;

use Phalcon\Mvc\Model\Relation;

/**
 * 属性定义表
 *
 * Class TbProperty
 * @package Asa\Erp
 */
class TbProperty extends BaseModel
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
    public $displayindex;

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
