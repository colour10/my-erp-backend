<?php
namespace Asa\Erp;

/**
 * 发货单主表
 */
class TbShipping extends BaseModel
{
    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_shipping');

        // 订单-订单详情，一对多
        $this->hasMany(
            "id",
            "\Asa\Erp\TbShippingDetail",
            "shippingid",
            [
                'alias' => 'shippingDetail'
            ]
        );
    }

    function getDetail($onlyOrder=false) {
        $details = $this->shippingDetail;

        //找出出库单中涉及到的订单的产品，并查询这些产品的订单明细
        $hash = [];
        foreach($details as $row) { 
            $hash[$row->orderbrandid] = 1; 
        }

        $id_array = array_keys($hash);
        if(count($id_array)>0) {
            $orderbrands = TbOrderBrand::find(
                sprintf("id in (%s)", implode(",", $id_array))
            )->toArray();

            $orderbranddetails = TbOrderBrandDetail::find([
                sprintf("orderbrandid in (%s)", implode(",", $id_array)),
                "order" => "productid asc"
            ])->toArray();
        }
        else {
            $orderbrands = [];
            $orderbranddetails = [];
        }

        return [
            "form" => $this->toArray(),
            "shippingdetails" => $details->toArray(),
            "orderbrands" => $orderbrands,
            "orderbranddetails" => $orderbranddetails
        ];
    }
}
