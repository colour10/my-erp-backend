<?php

namespace Asa\Erp;

/**
 * 销售单明细表
 *
 * Class TbSalesdetails
 * @package Asa\Erp
 */
class TbSalesdetails extends BaseModel
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
    public $salesid;

    /**
     *
     * @var integer
     */
    public $productstockid;

    /**
     *
     * @var integer
     */
    public $number;

    /**
     *
     * @var double
     */
    public $dealprice;

    /**
     *
     * @var double
     */
    public $price;

    /**
     *
     * @var integer
     */
    public $priceid;

    /**
     *
     * @var double
     */
    public $cost;

    /**
     *
     * @var integer
     */
    public $costcurrency;

    /**
     *
     * @var integer
     */
    public $update_time;

    /**
     * 初始化
     */
    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_salesdetails');

        // 销售详情表-销售主表，一对多反向
        $this->belongsTo(
            'salesid',
            TbSales::class,
            'id',
            [
                'alias' => 'sales',
            ]
        );

        // 销售详情表-库存表，一对多反向
        $this->belongsTo(
            'productstockid',
            TbProductstock::class,
            'id',
            [
                'alias' => 'productstock',
            ]
        );
    }

    function getLocalProductstock()
    {
        return $this->sales->warehouse->getLocalStock($this->productstock);
    }

    function preReduceStockExecute()
    {
        $productstock = $this->getLocalProductstock();

        $productstock->preReduceStockExecute($this->number, TbProductstock::SALES, $this->id);

        $this->cost = $productstock->product->cost;
        $this->costcurrency = $productstock->product->costcurrency;
        $this->update_time = time();
        return $this->update();
    }
}
