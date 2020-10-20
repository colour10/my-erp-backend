<?php

namespace Asa\Erp;

use Phalcon\Mvc\Model\Relation;

/**
 * 品牌表
 *
 * Class TbBrand
 * @package Asa\Erp
 * @property int $id 主键id
 * @property string|null $name_cn 中文名称
 * @property string|null $name_en 英文名称
 * @property string|null $name_hk 粤语名称
 * @property string|null $name_fr 法语名称
 * @property string|null $name_it 意大利语名称
 * @property string|null $name_sp 西班牙语名称
 * @property string|null $name_de 德语名称
 * @property int|null $countryid 公司id
 * @property string|null $filename LOGO
 * @property string|null $memo 备注
 * @property string|null $officialwebsite 网址
 * @property string|null $worldcode1 国际码前3位
 * @property string|null $worldcode2 国际码中间3位
 * @property string|null $worldcode3 国际码后3位
 * @property-read TbCountry|null $country 国家
 * @property-read TbProduct|null $products 产品
 */
class TbBrand extends BaseModel
{
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
