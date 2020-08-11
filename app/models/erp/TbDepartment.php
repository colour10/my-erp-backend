<?php

namespace Asa\Erp;

/**
 * 部门表
 * Class TbDepartment
 * @package Asa\Erp
 */
class TbDepartment extends BaseModel
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
    public $name;

    /**
     *
     * @var string
     */
    public $memo;

    /**
     *
     * @var integer
     */
    public $companyid;

    /**
     *
     * @var integer
     */
    public $priceid;

    /**
     *
     * @var integer
     */
    public $spotid;

    /**
     *
     * @var integer
     */
    public $up_dp_id;

    /**
     *
     * @var string
     */
    public $checkingflag;

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
