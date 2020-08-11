<?php

namespace Asa\Erp;

/**
 * 仓库-用户关联表
 * Class TbWarehouseUser
 * @package Asa\Erp
 */
class TbWarehouseUser extends BaseModel
{
    /**
     *
     * @var integer
     */
    public $id;

    /**
     *
     * @var integer
     */
    public $warehouseid;

    /**
     *
     * @var integer
     */
    public $userid;

    /**
     *
     * @var integer
     */
    public $warehouseroleid;

    /**
     *
     * @var string
     */
    public $create_time;

    /**
     *
     * @var integer
     */
    public $companyid;

    // 定义角色常量
    // 管理员
    const ROLE_MANAGER = 1;
    // 销售员
    const ROLE_SELLER = 2;

    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_warehouse_user');

        // 仓库-用户关联表 - 仓库表，一对多反向
        $this->belongsTo(
            'warehouseid',
            TbWarehouse::class,
            'id',
            [
                'alias' => 'warehouse',
            ]
        );

        // 仓库-用户关联表 - 用户表，一对多反向
        $this->belongsTo(
            'userid',
            TbUser::class,
            'id',
            [
                'alias' => 'user',
            ]
        );
    }
}
