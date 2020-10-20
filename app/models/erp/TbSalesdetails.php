<?php

namespace Asa\Erp;

/**
 * 销售单明细表
 *
 * Class TbSalesdetails
 * @package Asa\Erp
 * @property int $id 主键id
 * @property int $salesid 销售单id
 * @property int|null $productstockid 库存id
 * @property int|null $number 数量
 * @property float|null $dealprice 成交总价
 * @property float|null $price 基准单价
 * @property int|null $priceid 价格id
 * @property float|null $cost 成本
 * @property int|null $costcurrency 成本货币单位id
 * @property int|null $update_time 更新时间
 * @property-read TbSales|null $sales 销售主表
 * @property-read TbProductstock|null $productstock 库存表
 */
class TbSalesdetails extends BaseModel
{
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
