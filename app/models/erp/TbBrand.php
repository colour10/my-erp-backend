<?php
namespace Asa\Erp;
use Phalcon\Mvc\Model\Relation;

/**
 * 品牌表
 */
class TbBrand extends BaseModel
{
    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_brand');

        // 品牌-国家表，一对多反向
        $this->belongsTo(
            'countryid',
            '\Asa\Erp\TbCountry',
            'id',
            [
                'alias' => 'country'
            ]
        );

        //
        $this->hasMany(
            "id",
            "\Asa\Erp\TbProduct",
            "brandid",
            [
                'alias' => 'products',
                'foreignKey' => [
                    // 关联字段存在性验证
                    'action' => Relation::ACTION_RESTRICT,
                    "message"    => "/1003/品牌已经使用，不能删除/"
                ],
            ]
        );
    }

    public function getRules() {
        $factory = $this->getValidatorFactory();
        return [
            'countryid' => $factory->tableid('guishuguojia'),
            'name_cn' => $factory->presenceOfMultiple('pinpaimingcheng')
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