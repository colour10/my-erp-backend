<?php

namespace Asa\Erp;

/**
 * 发货单主表
 *
 * Class TbShipping
 * @package Asa\Erp
 * @property int $id 主键id
 * @property int|null $companyid 公司id
 * @property bool|null $status 状态：1-在途；2=待入库；3=已入库
 * @property string|null $orderno 发货单号
 * @property int|null $supplierid 供货商id
 * @property null $maketime 制单日期
 * @property int|null $makestaff 制单人
 * @property int|null $currency 货币类型
 * @property float|null $total 总金额
 * @property string|null $memo 备注
 * @property int|null $brandid 品牌id
 * @property int|null $ageseason 年份季节id
 * @property bool|null $seasontype 0-pre ,1-main ,2-fashion show
 * @property float|null $exchangerate 汇率
 * @property int|null $finalsupplierid 供货单位id
 * @property string|null $flightno 航班号
 * @property string|null $flightdate 起飞时间
 * @property string|null $arrivaldate 预计到货时间
 * @property string|null $mblno 主单号
 * @property string|null $hblno 子单号
 * @property string|null $dispatchport 发货港
 * @property string|null $deliveryport 到货港
 * @property int|null $transcompany 空运商
 * @property bool|null $isexamination 是否海关验货
 * @property string|null $examinationresult 验货结果
 * @property null $clearancedate 放行时间
 * @property null $pickingdate 预计提货时间
 * @property string|null $motortransportpool 车队
 * @property int|null $warehouseid 仓库id
 * @property int|null $box_number 箱数
 * @property float|null $weight 重量
 * @property float|null $volume 体积
 * @property string|null $issjyh 是否商检验货
 * @property int|null $sellerid 销售人id
 * @property string|null $sjyhresult 商检验货结果
 * @property int|null $buyerid 购买人id
 * @property bool|null $transporttype 0-by air 1-快递 2-中转
 * @property bool|null $paytype 0- t/t
 * @property bool|null $property 0-自采 1-代销
 * @property string|null $payoutpercentage 属性
 * @property string|null $pickingaddress 国外提货地址
 * @property float|null $chargedweight 计费重量
 * @property string|null $paydate 付款时间
 * @property string|null $apickingdate 安排提货时间
 * @property string|null $aarrivaldate 到库时间
 * @property string|null $invoiceno 国外发票号
 * @property int|null $dd_company 代垫单位
 * @property string|null $estimatedate 预计到达日期
 * @property int|null $bussinesstype 货物属性：0-期货 1-现货
 * @property null $warehousingtime 入库时间
 * @property int|null $warehousingstaff 入库人
 * @property null $confirmtime 确认时间
 * @property int|null $confirmstaff 确认人
 * @property-read TbShippingDetail|null $shippingDetail 订单详情
 * @property-read TbShippingFee|null $shippingFee 发货单费用
 */
class TbShipping extends BaseModel
{
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

        // 订单-发货单费用，一对多
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
