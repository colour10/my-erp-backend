<?php

namespace Asa\Erp;

use Phalcon\Mvc\Model\Relation;

/**
 * 品牌表
 * Class TbBrand
 * @package Asa\Erp
 */
class TbBrand extends BaseModel
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
    public $countryid;

    /**
     *
     * @var string
     */
    public $filename;

    /**
     *
     * @var string
     */
    public $memo;

    /**
     *
     * @var string
     */
    public $officialwebsite;

    /**
     *
     * @var string
     */
    public $worldcode1;

    /**
     *
     * @var string
     */
    public $worldcode2;

    /**
     *
     * @var string
     */
    public $worldcode3;

    /**
     * 初始化
     */
    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_brand');

        // 品牌-国家表，一对多反向
        $this->belongsTo(
            'countryid',
            TbCountry::class,
            'id',
            [
                'alias' => 'country',
            ]
        );

        // 品牌-产品表，一对多
        $this->hasMany(
            "id",
            TbProduct::class,
            "brandid",
            [
                'alias'      => 'products',
                'foreignKey' => [
                    // 关联字段存在性验证
                    'action'  => Relation::ACTION_RESTRICT,
                    "message" => "/1003/品牌已经使用，不能删除/",
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
        $factory = $this->getValidatorFactory();
        return [
            'countryid' => $factory->tableid('guishuguojia'),
            'name_cn'   => $factory->presenceOfMultiple('pinpaimingcheng'),
        ];
    }

    /**
     * 获取品牌归属国家
     */
    public function getCountry()
    {
        $lang = $this->getDI()->get("session")->get("language");
        return $this->country ? $this->country->{'name_' . $lang} : '';
    }
}
