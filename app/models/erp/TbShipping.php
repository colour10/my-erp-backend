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

        // 订单-订单详情，一对多
        $this->hasMany(
            "id",
            "\Asa\Erp\TbShippingFee",
            "shippingid",
            [
                'alias' => 'shippingFee'
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

    function getCostList($currencyid) {
        $result = [];
        $total_number = 0;
        $total_amount = 0;
        foreach($this->shippingDetail as $detail) {
            if($this->status==3) {
                $amount = TbExchangeRate::convert($this->companyid, $detail->costcurrency, $currencyid, $detail->warehousingnumber*$detail->cost);
            }
            else {
                $amount = TbExchangeRate::convert($this->companyid, $detail->currencyid, $currencyid, $detail->warehousingnumber*$detail->price);
            }

            $total_number += $detail->warehousingnumber;
            $total_amount += $amount['number'];

            if(isset($result[$detail->productid])) {
                $row = $result[$detail->productid];
            }
            else {
                $row = ["number"=>0, "amount"=>0, "productid"=>$detail->productid];
            }
            $row["number"] += $detail->warehousingnumber;
            $row["amount"] += $amount['number'];
            $result[$detail->productid] = $row;
        }

        //直接返回结果
        if($this->status==3) {
            return $result;
        }

        foreach ($this->shippingFee as $shippingFee) {
            $fee_amount = TbExchangeRate::convert($this->companyid, $shippingFee->currencyid, $currencyid, $shippingFee->amount);

            if($shippingFee->feename->is_amortize==1) {
                //print_r($shippingFee->feename->toArray());

                if($shippingFee->feename->amortize_type==1) {
                    //按数量摊销

                    $average = $fee_amount['number']/$total_number;
                    //print_r( $average);
                    foreach($result as $key=>$row) {
                        $row['amount'] += $average*$row['number'];
                        $result[$key] = $row;
                    }
                }
                else {
                    //按金额摊销
                    foreach($result as $key=>$row) {
                        $row['amount'] += $fee_amount['number']*$row['amount']/$total_amount;
                        $result[$key] = $row;
                    }
                }
            }
        }

        return $result;
    }
}
