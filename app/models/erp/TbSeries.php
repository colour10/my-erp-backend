<?php

namespace Asa\Erp;

use Phalcon\Mvc\Model\Relation;

/**
 * 品牌系列，品牌相关数据
 *
 * Class TbSeries
 * @package Asa\Erp
 */
class TbSeries extends BaseModel
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
     * @var string
     */
    public $code;

    /**
     *
     * @var integer
     */
    public $brandid;

    /**
     *
     * @var integer
     */
    public $displayindex;

    /**
     *
     * @var integer
     */
    public $companyid;

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
