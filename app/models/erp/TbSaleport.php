<?php

namespace Asa\Erp;

use Phalcon\Mvc\Model\ResultsetInterface;

/**
 * 销售端口表
 */
class TbSaleport extends BaseModel
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
     * @var double
     */
    public $discount;

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

    /**
     * 初始化
     */
    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_saleport');

        // 销售端口表-（销售端口-仓库对应表），一对多
        $this->hasMany(
            "id",
            TbSaleportWarehouse::class,
            "saleportid",
            [
                'alias' => 'saleportWarehouses',
            ]
        );
    }

    /**
     * 获取当前销售端口对应的仓库
     * @return array|ResultsetInterface [type] [description]
     */
    function getWarehouseList()
    {
        $array = Util::recordListColumn($this->saleportWarehouses, 'warehouseid');

        return TbWarehouse::findByIdString($array, 'id');
    }

    /**
     *  获取该销售端口对应的所有库存
     * @return array|ResultsetInterface [type] [description]
     */
    function getProductstockList()
    {
        $array = Util::recordListColumn($this->saleportWarehouses, 'warehouseid');

        return TbProductstock::findByIdString($array, 'warehouseid');
    }

    /**
     *  获取该销售端口对应的所有商品库存
     * @return array|mixed [type] [description]
     */
    function getProductList()
    {
        $array = Util::recordListColumn($this->saleportWarehouses, 'warehouseid');
        if (count($array) == 0) {
            return $array;
        }

        return TbProductstock::sum([
            sprintf("warehouseid in (%s) and defective_level=0", implode(',', $array)),
            "group"  => 'productid',
            "column" => 'number',
        ]);
    }
}
