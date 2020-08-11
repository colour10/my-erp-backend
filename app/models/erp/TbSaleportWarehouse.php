<?php

namespace Asa\Erp;

/**
 * 销售端口-仓库对应表
 *
 * Class TbSaleportWarehouse
 * @package Asa\Erp
 */
class TbSaleportWarehouse extends BaseModel
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
    public $saleportid;

    /**
     *
     * @var integer
     */
    public $warehouseid;

    /**
     *
     * @var string
     */
    public $create_time;

    /**
     * 初始化
     */
    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_saleport_warehouse');
    }
}
