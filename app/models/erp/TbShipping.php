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
            "orderbranddetails" => $orderbranddetails,
            // 只有已经确认过的入库单，才显示成本。
            "costs" => $this->status==2 || $this->status==3 ? $this->getCostList() : []
        ];
    }

    function getCostList() {
        $result = [];
        $total_number = 0;
        $total_amount = 0;
        foreach($this->shippingDetail as $detail) {
            if($this->status==3) {
                $amount = $detail->warehousingnumber*$detail->cost;
            }
            else {
                $amount = $detail->warehousingnumber*$detail->price;
            }

            $total_number += $detail->warehousingnumber;
            $total_amount += $amount;

            if(isset($result[$detail->productid])) {
                $row = $result[$detail->productid];
            }
            else {
                /*
                 * amount 保存当前的商品的总金额，包括商品售价及摊销的费用
                 * amount_ 仅仅是商品的总金额，用来计算按金额摊销的费用的，避免已经按数量摊销过，在按照金额摊销就错了。
                 */
                $row = ["number"=>0, "amount"=>0, "amount_"=>0, "productid"=>$detail->productid];
            }
            $row["number"] += $detail->warehousingnumber;
            $row["amount"] += $amount;
            $row["amount_"] = $row["amount"];
            $result[$detail->productid] = $row;
        }

        // 如果已经入库了，说明已经分摊过了，直接返回结果
        if($this->status==3) {
            return $result;
        }

        foreach ($this->shippingFee as $shippingFee) {
            $fee_amount = round($shippingFee->amount*$shippingFee->exchangerate, 2); // TbExchangeRate::convert($this->companyid, $shippingFee->currencyid, $currencyid, $shippingFee->amount);

            if($shippingFee->feename->is_amortize==1) {
                //print_r($shippingFee->feename->toArray());

                if($shippingFee->feename->amortize_type==1) {
                    // 按数量摊销
                    if($total_number>0) {
                        $average = $fee_amount/$total_number;
                        //print_r( $average);
                        //echo ",".$fee_amount['number'];
                        foreach($result as $key=>$row) {
                            $row['amount'] += $average*$row['number'];
                            $result[$key] = $row;
                        }
                    }
                }
                else {
                    // 按金额摊销
                    if($total_amount>0) {
                        foreach($result as $key=>$row) {
                            $row['amount'] += $fee_amount*$row['amount_']/$total_amount;
                            $result[$key] = $row;
                        }
                    }
                }
            }
        }

        //print_r($result);

        return $result;
    }

    function getOrderbrandList() {
        $sql = sprintf("SELECT distinct orderbrandid FROM tb_shipping_detail WHERE shippingid=%d", $this->id);
        $rows = $this->getDI()->get('db')->fetchAll($sql);

        $result = [];

        if(count($rows)>0) {
            $array = [];
            foreach ($rows as $row) {
                $array[] = $row['orderbrandid'];
            }

            $result = TbOrderBrand::find(
                sprintf("id in (%s)", implode(',', $array))
            )->toArray();
        }

        return $result;
    }
}
