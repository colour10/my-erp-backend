<?php

namespace Asa\Erp;

/**
 * 部门表
 *
 * Class TbDepartment
 * @package Asa\Erp
 * @property int $id 主键id
 * @property string|null $name 名称
 * @property string|null $memo 备注
 * @property int $companyid 公司id
 * @property int|null $priceid 基础价格id
 * @property int|null $spotid 销售端口编号
 * @property int|null $up_dp_id 上级部门ID
 * @property string|null $checkingflag 核算部门
 * @property-read TbCompany|null $company 公司
 */
class TbDepartment extends BaseModel
{
    /**
     * 初始化
     */
    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_department');

        // 部门-公司表，一对多反向
        $this->belongsTo(
            'companyid',
            TbCompany::class,
            'id',
            [
                'alias' => 'company',
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
            'name' => $factory->presenceOf('bumenmingcheng'),
        ];
    }
}
