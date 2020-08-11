<?php

namespace Asa\Erp;

use Phalcon\Mvc\Model\Relation;

/**
 * 尺码组
 *
 * Class TbSizetop
 * @package Asa\Erp
 */
class TbSizetop extends BaseModel
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
    public $displayindex;

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
        $this->setSource('tb_sizetop');

        // 尺码组-尺码详情，一对多
        $this->hasMany(
            "id",
            TbSizecontent::class,
            "topid",
            [
                'alias'      => 'sizecontents',
                'foreignKey' => [
                    // 关联字段存在性验证
                    'action'  => Relation::ACTION_RESTRICT,
                    "message" => "/1003/尺码组已经使用，不能删除/",
                ],
            ]
        );

        // 尺码组-商品表，一对多
        $this->hasMany(
            "id",
            TbProduct::class,
            "sizetopid",
            [
                'alias'      => 'products',
                'foreignKey' => [
                    // 关联字段存在性验证
                    'action'  => Relation::ACTION_RESTRICT,
                    "message" => "/1003/尺码组已经使用，不能删除/",
                ],
            ]
        );
    }

    /**
     * 验证信息
     *
     * @return array
     */
    public function getRules()
    {
        $factory = $this->getValidatorFactory();
        return [
            'name_cn'      => $factory->presenceOf('jiancheng'),
            'name_en'      => $factory->presenceOf('mingcheng'),
            'displayindex' => [$factory->presenceOf('paixu')],
        ];
    }
}
