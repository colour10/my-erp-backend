<?php

namespace Asa\Erp;

use Phalcon\Mvc\Model\Relation;

/**
 * 基础资料，商品尺寸表
 * Class TbUlnarinch
 * @package Asa\Erp
 */
class TbUlnarinch extends BaseModel
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
     *
     * @var integer
     */
    public $brandgroupchildid;

    /**
     * 初始化
     */
    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_ulnarinch');

        // 商品尺寸表-商品表，一对多
        $this->hasMany(
            "id",
            TbProduct::class,
            "ulnarinch",
            [
                'alias'      => 'products',
                'foreignKey' => [
                    // 关联字段存在性验证
                    'action'  => Relation::ACTION_RESTRICT,
                    "message" => "/1003/商品尺寸已经使用，不能删除/",
                ],
            ]
        );
    }
}
