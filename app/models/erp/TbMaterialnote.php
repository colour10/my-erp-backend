<?php

namespace Asa\Erp;

use Phalcon\Mvc\Model\Relation;

/**
 * 基础资料，材质备注表
 *
 * Class TbMaterialnote
 * @package Asa\Erp
 */
class TbMaterialnote extends BaseModel
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
    public $content_cn;

    /**
     *
     * @var string
     */
    public $content_en;

    /**
     *
     * @var string
     */
    public $content_hk;

    /**
     *
     * @var string
     */
    public $content_fr;

    /**
     *
     * @var string
     */
    public $content_it;

    /**
     *
     * @var string
     */
    public $content_sp;

    /**
     *
     * @var string
     */
    public $content_de;

    /**
     *
     * @var integer
     */
    public $displayindex;

    /**
     *
     * @var string
     */
    public $brandgroupids;

    /**
     * 初始化
     */
    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_materialnote');

        $this->hasMany(
            "id",
            TbProductMaterial::class,
            "materialnoteid",
            [
                'alias'      => 'productMaterial',
                'foreignKey' => [
                    // 关联字段存在性验证
                    'action'  => Relation::ACTION_RESTRICT,
                    "message" => "/1003/材质备注已经使用，不能删除/",
                ],
            ]
        );
    }
}
