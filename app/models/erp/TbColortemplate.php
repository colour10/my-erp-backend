<?php

namespace Asa\Erp;

use Phalcon\Mvc\Model\Relation;

/**
 * 基础资料，ASA颜色模板表
 * Class TbColortemplate
 * @package Asa\Erp
 */
class TbColortemplate extends BaseModel
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
    public $picture;

    /**
     *
     * @var string
     */
    public $code;

    /**
     *
     * @var integer
     */
    public $color_system_id;

    /**
     *
     * @var string
     */
    public $created_at;

    /**
     *
     * @var string
     */
    public $updated_at;

    /**
     * 初始化
     */
    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_colortemplate');

        // 颜色-产品，一对多
        $this->hasMany(
            "id",
            TbProduct::class,
            "brandcolor",
            [
                'alias'      => 'products',
                'foreignKey' => [
                    // 关联字段存在性验证
                    'action'  => Relation::ACTION_RESTRICT,
                    "message" => "/1003/色系已经使用，不能删除/",
                ],
            ]
        );

        // 颜色-销售类型，一对多
        $this->hasMany(
            "id",
            TbSaleType::class,
            "colortemplateid",
            [
                'alias'      => 'saleTypes',
                'foreignKey' => [
                    // 关联字段存在性验证
                    'action'  => Relation::ACTION_RESTRICT,
                    "message" => "/1003/色系已经使用，不能删除/",
                ],
            ]
        );

        // 颜色-色系，一对多反向
        $this->belongsTo(
            'color_system_id',
            TbColorSystem::class,
            'id',
            [
                'alias' => 'colorsystem',
            ]
        );
    }
}
