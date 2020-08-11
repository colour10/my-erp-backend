<?php

namespace Asa\Erp;

use Phalcon\Mvc\Model\Relation;

/**
 * 销售属性表
 *
 * Class TbSaleType
 * @package Asa\Erp
 */
class TbSaleType extends BaseModel
{
    /**
     *
     * @var integer
     */
    public $id;

    /**
     *
     * @var integer
     */
    public $colortemplateid;

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
        $this->setSource('tb_sale_type');

        // 销售属性表-商品表，一对多
        $this->hasMany(
            "id",
            TbProduct::class,
            "saletypeid",
            [
                'alias'      => 'products',
                'foreignKey' => [
                    // 关联字段存在性验证
                    'action'  => Relation::ACTION_RESTRICT,
                    "message" => "/1003/销售属性已经使用，不能删除/",
                ],
            ]
        );
    }
}
