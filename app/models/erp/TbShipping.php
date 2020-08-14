<?php

namespace Asa\Erp;

/**
 * 发货单主表
 *
 * Class TbShipping
 * @package Asa\Erp
 */
class TbShipping extends BaseModel
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
    public $companyid;

    /**
     *
     * @var integer
     */
    public $status;

    /**
     *
     * @var string
     */
    public $orderno;

    /**
     *
     * @var integer
     */
    public $supplierid;

    /**
     *
     * @var string
     */
    public $maketime;

    /**
     *
     * @var integer
     */
    public $makestaff;

    /**
     *
     * @var integer
     */
    public $currency;

    /**
     *
     * @var double
     */
    public $total;

    /**
     *
     * @var string
     */
    public $memo;

    /**
     *
     * @var integer
     */
    public $brandid;

    /**
     *
     * @var integer
     */
    public $ageseason;

    /**
     *
     * @var integer
     */
    public $seasontype;

    /**
     *
     * @var double
     */
    public $exchangerate;

    /**
     *
     * @var integer
     */
    public $finalsupplierid;

    /**
     *
     * @var string
     */
    public $flightno;

    /**
     *
     * @var string
     */
    public $flightdate;

    /**
     *
     * @var string
     */
    public $arrivaldate;

    /**
     *
     * @var string
     */
    public $mblno;

    /**
     *
     * @var string
     */
    public $hblno;

    /**
     *
     * @var string
     */
    public $dispatchport;

    /**
     *
     * @var string
     */
    public $deliveryport;

    /**
     *
     * @var integer
     */
    public $transcompany;

    /**
     *
     * @var integer
     */
    public $isexamination;

    /**
     *
     * @var string
     */
    public $examinationresult;

    /**
     *
     * @var string
     */
    public $clearancedate;

    /**
     *
     * @var string
     */
    public $pickingdate;

    /**
     *
     * @var string
     */
    public $motortransportpool;

    /**
     *
     * @var integer
     */
    public $warehouseid;

    /**
     *
     * @var integer
     */
    public $box_number;

    /**
     *
     * @var double
     */
    public $weight;

    /**
     *
     * @var double
     */
    public $volume;

    /**
     *
     * @var string
     */
    public $issjyh;

    /**
     *
     * @var integer
     */
    public $sellerid;

    /**
     *
     * @var string
     */
    public $sjyhresult;

    /**
     *
     * @var integer
     */
    public $buyerid;

    /**
     *
     * @var integer
     */
    public $transporttype;

    /**
     *
     * @var integer
     */
    public $paytype;

    /**
     *
     * @var integer
     */
    public $property;

    /**
     *
     * @var string
     */
    public $payoutpercentage;

    /**
     *
     * @var string
     */
    public $pickingaddress;

    /**
     *
     * @var double
     */
    public $chargedweight;

    /**
     *
     * @var string
     */
    public $paydate;

    /**
     *
     * @var string
     */
    public $apickingdate;

    /**
     *
     * @var string
     */
    public $aarrivaldate;

    /**
     *
     * @var string
     */
    public $invoiceno;

    /**
     *
     * @var integer
     */
    public $dd_company;

    /**
     *
     * @var string
     */
    public $estimatedate;

    /**
     *
     * @var integer
     */
    public $bussinesstype;

    /**
     *
     * @var string
     */
    public $warehousingtime;

    /**
     *
     * @var integer
     */
    public $warehousingstaff;

    /**
     *
     * @var string
     */
    public $confirmtime;

    /**
     *
     * @var integer
     */
    public $confirmstaff;

    // 定义订单状态
    // 在途
    const STATUS_WAY = 1;
    // 待入库
    const STATUS_STORAGE = 2;
    // 已入库，费用已经摊销
    const STATUS_AMORTIZED = 3;

    /**
     * 初始化
     */
    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_shipping');

        // 订单-订单详情，一对多
        $this->hasMany(
            "id",
            TbShippingDetail::class,
            "shippingid",
            [
                'alias' => 'shippingDetail',
            ]
        );

        // 订单-订单详情，一对多
        $this->hasMany(
            "id",
            TbShippingFee::class,
            "shippingid",
            [
                'alias' => 'shippingFee',
            ]
        );
    }

    /**
     * 获取明细
     * @param bool $onlyOrder
     * @return array
     */
    function getDetail($onlyOrder = false)
    {
        $details = $this->shippingDetail;

        //找出出库单中涉及到的订单的产品，并查询这些产品的订单明细
        $hash = [];
        foreach ($details as $row) {
            $hash[$row->orderbrandid] = 1;
        }

        $id_array = array_keys($hash);
        if (count($id_array) > 0) {
            $orderbrands = TbOrderBrand::find(
                sprintf("id in (%s)", implode(",", $id_array))
            )->toArray();

            $orderbranddetails = TbOrderBrandDetail::find([
                sprintf("orderbrandid in (%s)", implode(",", $id_array)),
                "order" => "productid asc",
            ])->toArray();
        } else {
            $orderbrands = [];
            $orderbranddetails = [];
        }

        return [
            "form"              => $this->toArray(),
            "shippingdetails"   => $details->toArray(),
            "orderbrands"       => $orderbrands,
            "orderbranddetails" => $orderbranddetails,
            // 只有已经确认过的入库单，才显示成本, 也就是状态为2或3
            "costs"             => $this->status == self::STATUS_STORAGE || $this->status == self::STATUS_AMORTIZED ? $this->getCostList() : [],
        ];
    }

    /**
     * 获取成本列表
     *
     * @return array
     */
    function getCostList()
    {
        $result = [];
        $total_number = 0;
        $total_amount = 0;
        foreach ($this->shippingDetail as $detail) {
            // 状态为3
            if ($this->status == self::STATUS_AMORTIZED) {
                // 如果已经入库，总价格 = 入库数量 * 成本价
                $amount = $detail->warehousingnumber * $detail->cost;
            } else {
                // 如果未入库(状态2：费用未摊销)，总价格 = 入库数量 * 商品价格
                $amount = $detail->warehousingnumber * $detail->price;
            }

            // 累计总数量和总金额
            $total_number += $detail->warehousingnumber;
            $total_amount += $amount;

            // 按照 key 值 productid 进行汇总
            if (isset($result[$detail->productid])) {
                $row = $result[$detail->productid];
            } else {
                /*
                 * amount 保存当前的商品的总金额，包括商品售价及摊销的费用
                 * amount_ 仅仅是商品的总金额，用来计算按金额摊销的费用的，避免已经按数量摊销过，在按照金额摊销就错了。
                 */
                $row = ["number" => 0, "amount" => 0, "amount_" => 0, "productid" => $detail->productid];
            }
            $row["number"] += $detail->warehousingnumber;
            $row["amount"] += $amount;
            $row["amount_"] = $row["amount"];
            $result[$detail->productid] = $row;
        }

        // 如果已经入库了，说明已经分摊过了，直接返回结果
        if ($this->status == self::STATUS_AMORTIZED) {
            return $result;
        }

        // 费用遍历
        foreach ($this->shippingFee as $shippingFee) {
            $fee_amount = round($shippingFee->amount * $shippingFee->exchangerate, 2);

            if ($shippingFee->feename->is_amortize == 1) {
                // 运费是按照数量摊销
                if ($shippingFee->feename->amortize_type == 1) {
                    // 按数量摊销
                    if ($total_number > 0) {
                        $average = $fee_amount / $total_number;
                        foreach ($result as $key => $row) {
                            $row['amount'] += $average * $row['number'];
                            $result[$key] = $row;
                        }
                    }
                } else {
                    // 关税是按照金额摊销
                    // 按金额摊销
                    if ($total_amount > 0) {
                        foreach ($result as $key => $row) {
                            $row['amount'] += $fee_amount * $row['amount_'] / $total_amount;
                            $result[$key] = $row;
                        }
                    }
                }
            }
        }

        // 返回
        return $result;
    }

    /**
     * 前查 - 品牌订单，这个是正常流程的
     *
     * @return array
     */
    function getOrderbrandList()
    {
        // 查找唯一的 orderbrandid，用于前查
        $sql = sprintf("SELECT distinct orderbrandid FROM tb_shipping_detail WHERE shippingid=%d", $this->id);
        $rows = $this->getDI()->get('db')->fetchAll($sql);

        $result = [];

        if (count($rows) > 0) {
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

    /**
     * 前查 - 普通订单，这个是简易流程
     *
     * @return array
     */
    function getOrderList()
    {
        // 查找唯一的 orderid，用于前查
        $sql = sprintf("SELECT distinct orderid FROM tb_shipping_detail WHERE shippingid=%d", $this->id);
        $rows = $this->getDI()->get('db')->fetchAll($sql);

        $result = [];

        if (count($rows) > 0) {
            $array = [];
            foreach ($rows as $row) {
                $array[] = $row['orderid'];
            }

            $result = TbOrder::find(
                sprintf("id in (%s)", implode(',', $array))
            )->toArray();
        }

        return $result;
    }
}
