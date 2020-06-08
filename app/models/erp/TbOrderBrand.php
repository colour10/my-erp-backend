<?php

namespace Asa\Erp;

use Phalcon\Mvc\Model\ResultsetInterface;

/**
 * 品牌订单
 */
class TbOrderBrand extends BaseModel
{
    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_order_brand');

        $this->hasMany(
            "id",
            "\Asa\Erp\TbOrderBrandDetail",
            "orderbrandid",
            [
                'alias' => 'orderbranddetail',
            ]
        );
    }

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
