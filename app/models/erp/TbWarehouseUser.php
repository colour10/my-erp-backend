<?php

namespace Asa\Erp;

/**
 * 仓库-用户关联表
 * Class TbWarehouseUser
 * @package Asa\Erp
 */
class TbWarehouseUser extends BaseModel
{
    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_warehouse_user');

        $this->belongsTo(
            'warehouseid',
            '\Asa\Erp\TbWarehouse',
            'id',
            [
                'alias' => 'warehouse',
            ]
        );

        $this->belongsTo(
            'userid',
            '\Asa\Erp\TbUser',
            'id',
            [
                'alias' => 'user',
            ]
        );
    }
}
