<?php

namespace Asa\Erp;

use Phalcon\Mvc\Model\Relation;

/**
 * 公司表
 * Class TbCompany
 * @package Asa\Erp
 */
class TbCompany extends BaseModel
{
    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_company');

        // 公司-国家，一对多反向
        $this->belongsTo(
            'countryid',
            '\Asa\Erp\TbCountry',
            'id',
            [
                'alias' => 'country',
            ]
        );

        // 公司-部门，一对多
        $this->hasMany(
            "id",
            "\Asa\Erp\TbDepartment",
            "companyid",
            [
                'alias'      => 'departments',
                'foreignKey' => [
                    // 关联字段存在性验证
                    'action'  => Relation::ACTION_RESTRICT,
                    "message" => "#1003#",
                ],
            ]
        );

        // 公司-商品表，一对多
        $this->hasMany(
            "id",
            "\Asa\Erp\TbProduct",
            "companyid",
            [
                'alias'      => 'products',
                'foreignKey' => [
                    // 关联字段存在性验证
                    'action'  => Relation::ACTION_RESTRICT,
                    "message" => $this->getValidateMessage('hasmany-foreign-message', 'product'),
                ],
            ]
        );

        $this->belongsTo(
            'saleportid',
            '\Asa\Erp\TbSaleport',
            'id',
            [
                'alias' => 'shopSaleport',
            ]
        );
    }
}
