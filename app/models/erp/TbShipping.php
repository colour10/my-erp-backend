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
        $array = [];
        $hash = [];
        $shipping_list = [];
        foreach($details as $row) {   
            if($onlyOrder && $row->orderid<=0) {
                continue;
            }
            $key = sprintf("%s-%s", $row->productid, $row->orderid);
            $hash[$key] = 1; 
            $shipping_list[] = $row->toArray();
        }

        foreach($hash as $key=>$value) {
            $temp = explode('-', $key);
            $array[] = sprintf("(orderid=%d and productid=%d)", $temp[1], $temp[0]);
        }

        if(count($array)>0) {
            $orderdetails_list = TbOrderdetails::find(
                implode(" or ", $array)
            )->toArray();
        }
        else {
            $orderdetails_list = [];
        }

        return [
            "form" => $this->toArray(),
            "list" => $shipping_list,
            "orderdetails_list" => $orderdetails_list
        ];
    }
}
