<?php

namespace Asa\Erp;

use Phalcon\Mvc\Model\ResultsetInterface;

/**
 * 品牌订单
 *
 * Class TbOrderBrand
 * @package Asa\Erp
 */
class TbOrderBrand extends BaseModel
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
    public $makestaff;

    /**
     *
     * @var integer
     */
    public $supplierid;

    /**
     *
     * @var integer
     */
    public $finalsupplierid;

    /**
     *
     * @var string
     */
    public $orderno;

    /**
     *
     * @var string
     */
    public $foreignorderno;

    /**
     *
     * @var string
     */
    public $memo;

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
     * @var string
     */
    public $brandid;

    /**
     *
     * @var double
     */
    public $taxrebate;

    /**
     *
     * @var double
     */
    public $discount;

    /**
     *
     * @var integer
     */
    public $companyid;

    /**
     *
     * @var string
     */
    public $maketime;

    /**
     *
     * @var string
     */
    public $confirmdate;

    /**
     *
     * @var integer
     */
    public $confirmstaff;

    /**
     *
     * @var double
     */
    public $total;

    /**
     *
     * @var integer
     */
    public $status;

    /**
     *
     * @var integer
     */
    public $bussinesstype;

    /**
     *
     * @var integer
     */
    public $quantum;

    /**
     *
     * @var integer
     */
    public $total_number;

    /**
     *
     * @var double
     */
    public $total_price;

    /**
     *
     * @var double
     */
    public $total_discount_price;

    /**
     *
     * @var integer
     */
    public $currency;

    // 品牌订单状态
    // 1 - 待确认
    const STATUS_TO_BE_CONFIRMED = 1;
    // 2 - 代发货
    const STATUS_TO_BE_DELIVERED = 2;
    // 3 - 完成
    CONST STATUS_FINISHED = 3;

    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_order_brand');

        $this->hasMany(
            "id",
            TbOrderBrandDetail::class,
            "orderbrandid",
            [
                'alias' => 'orderbranddetail',
            ]
        );
    }

    /**
     * 获取订单明细
     *
     * @return array
     */
    public function getOrderDetail()
    {
        $data = [
            'form' => $this->toArray(),
            'list' => [],
        ];

        // 循环添加数据
        foreach ($this->orderbranddetail as $k => $orderdetail) {
            $data['list'][] = $orderdetail->toArray();
        }

        return $data;
    }

    /**
     * 获取明细列表
     *
     * @return ResultsetInterface
     */
    public function getDetailList()
    {
        return TbOrderBrandDetail::find([
            sprintf("orderbrandid=%d", $this->id),
            "order" => "productid asc",
        ]);
    }

    /**
     * 前查 - 获取客户订单列表，具体走向为：客户订单 <- 品牌订单
     *
     * @return array|ResultsetInterface
     */
    public function getOrderList()
    {
        // 查找唯一的 orderid，用于前查
        $sql = sprintf("SELECT distinct orderid FROM tb_order_brand_detail WHERE orderbrandid=%d", $this->id);
        $rows = $this->getDI()->get('db')->fetchAll($sql);

        $result = [];

        if (count($rows) > 0) {
            $array = [];
            foreach ($rows as $row) {
                $array[] = $row['orderid'];
            }

            $result = TbOrder::find(
                sprintf("id in (%s)", implode(',', $array))
            );
        }

        return $result;
    }

    /**
     * 后查 - 发货单列表详情
     *
     * @return array
     */
    public function getShippingList()
    {
        // 查找唯一的 shippingid，用于后查
        $sql = sprintf("SELECT distinct shippingid FROM tb_shipping_detail WHERE orderbrandid=%d", $this->id);
        $rows = $this->getDI()->get('db')->fetchAll($sql);

        $result = [];

        if (count($rows) > 0) {
            $array = [];
            foreach ($rows as $row) {
                $array[] = $row['shippingid'];
            }

            $result = TbShipping::find(
                sprintf("id in (%s)", implode(',', $array))
            )->toArray();
        }

        return $result;
    }
}
