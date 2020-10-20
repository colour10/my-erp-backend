<?php

namespace Asa\Erp;

/**
 * 销售端口-仓库对应表
 *
 * Class TbSaleportWarehouse
 * @package Asa\Erp
 * @property int $id 主键id
 * @property int|null $saleportid 销售端口id
 * @property int|null $warehouseid 仓库id
 * @property null $create_time 创建时间
 */
class TbSaleportWarehouse extends BaseModel
{
    /**
     * 初始化
     */
    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_saleport_warehouse');
    }
}
