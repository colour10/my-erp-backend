<?php
namespace Asa\Erp;

/**
 * 销售端口-仓库对应表
 */
class TbSaleportWarehouse extends BaseModel
{
    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_saleport_warehouse');
    }
}
