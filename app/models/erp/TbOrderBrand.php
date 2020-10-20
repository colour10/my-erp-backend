<?php

namespace Asa\Erp;

use Phalcon\Mvc\Model\ResultsetInterface;

/**
 * 品牌订单
 *
 * Class TbOrderBrand
 * @package Asa\Erp
 * @property int $id 主键id
 * @property int|null $makestaff 制单人
 * @property int|null $supplierid 供货商
 * @property int|null $finalsupplierid 发货单位
 * @property string|null $orderno 公司订单号
 * @property string|null $foreignorderno 海外订单号
 * @property string|null $memo 备注
 * @property int|null $ageseason 年代季节
 * @property int|null $seasontype 0-pre ,1-main ,2-fashion show
 * @property string|null $brandid 品牌id
 * @property float|null $taxrebate 退税率
 * @property float|null $discount 折扣
 * @property int|null $companyid 公司id
 * @property null $maketime 订单时间
 * @property string|null $confirmdate 确认日期
 * @property int|null $confirmstaff 确认人
 * @property float|null $total 确认订单金额
 * @property int|null $status 订单状态；1=待确认；2=待发货；3=完成
 * @property int|null $bussinesstype 订单类型
 * @property int|null $quantum 限额
 * @property int|null $total_number 件数
 * @property float|null $total_price 总价
 * @property float|null $total_discount_price 折扣总价
 * @property int|null $currency 币种
 * @property-read TbOrderBrandDetail|null $orderbranddetail 品牌订单明细
 */
class TbOrderBrand extends BaseModel
{
    // 品牌订单状态
    // 1 - 待确认
    const STATUS_TO_BE_CONFIRMED = 1;
    // 2 - 代发货
    const STATUS_TO_BE_DELIVERED = 2;
    // 3 - 完成
    const STATUS_FINISHED = 3;

    /**
     * 初始化
     */
    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_order_brand');

        // 品牌订单-品牌订单明细，一对多
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
