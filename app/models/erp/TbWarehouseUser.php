<?php

namespace Asa\Erp;

/**
 * 仓库-用户关联表
 *
 * Class TbWarehouseUser
 * @package Asa\Erp
 * @property int $id 主键id
 * @property int $warehouseid 仓库id
 * @property int $userid 用户id
 * @property int|null $warehouseroleid 仓库角色：1=管理员；2：销售
 * @property null $create_time 创建时间
 * @property int|null $companyid 公司id
 * @property-read TbWarehouse|null $warehouse 仓库
 * @property-read TbUser|null $user 用户
 */
class TbWarehouseUser extends BaseModel
{
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
