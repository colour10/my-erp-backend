<?php
namespace Asa\Erp;

/**
 * 销售单 明细表
 */
class TbSalesdetails extends BaseModel
{
    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_salesdetails');

        // 销售详情表-销售主表，一对多反向
        $this->belongsTo(
            'salesid',
            '\Asa\Erp\TbSales',
            'id',
            [
                'alias' => 'sales'
            ]
        );

        $this->belongsTo(
            'productstockid',
            '\Asa\Erp\TbProductstock',
            'id',
            [
                'alias' => 'productstock'
            ]
        );
    }

    function getLocalProductstock() {
        return $this->sales->warehouse->getLocalStock($this->productstock);
    }

    function preReduceStockExecute() {
        $productstock = $this->getLocalProductstock();

        $productstock->preReduceStockExecute($this->number, TbProductstock::SALES, $this->id);

        $this->cost = $productstock->product->cost;
        $this->costcurrency = $productstock->product->costcurrency;
        $this->update_time = time();
        return $this->update();
    }
}
