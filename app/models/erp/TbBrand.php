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
    }

    public function getRules() {
        $factory = $this->getValidatorFactory();
        return [
            'countryid' => $factory->tableid('guishuguojia'),
            'name_cn' => $factory->presenceOfMultiple('pinpaimingcheng')
        ];
    }
}