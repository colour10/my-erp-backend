<?php

namespace Asa\Erp;

/**
 * 部门表
 * Class TbDepartment
 * @package Asa\Erp
 */
class TbDepartment extends BaseModel
{
    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_department');

        // 部门-公司表，一对多反向
        $this->belongsTo(
            'companyid',
            '\Asa\Erp\TbCompany',
            'id',
            [
                'alias' => 'company',
            ]
        );
    }

    public function getRules()
    {
        $factory = $this->getValidatorFactory();
        return [
            'name' => $factory->presenceOf('bumenmingcheng'),
        ];
    }
}
