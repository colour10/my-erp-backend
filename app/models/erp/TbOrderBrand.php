<?php
namespace Asa\Erp;

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
                'alias' => 'orderbranddetail'
            ]
        );
    }

    function getOrderDetail() {
        $data = [
            'form' => $this->toArray(),
            'list'=>[]
        ];

        // 循环添加数据
        foreach ($this->orderbranddetail as $k => $orderdetail) {
            $data['list'][] = $orderdetail->toArray();
        }

        return $data;
    }

    function getDetailList() {
        return TbOrderBrandDetail::find([
            sprintf("orderbrandid=%d", $this->id),
            "order" => "productid asc"
        ]);
    }

    /*function getOrderList() {
        $orderids = [];
        foreach ($this->orderbranddetail as $k => $orderdetail) {
            $orderids[] = $orderdetail->orderid;
        }

        if(count($orderids)>0) {
            return TbOrder::find(
                sprintf("id in (%s)", implode(',', $orderids))
            );
        }
        else {
            return [];
        }
    }*/

    function getOrderList() {
        $sql = sprintf("SELECT distinct orderid FROM tb_order_brand_detail WHERE orderbrandid=%d", $this->id);
        $rows = $this->getDI()->get('db')->fetchAll($sql);

        $result = [];

        if(count($rows)>0) {
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

    function getShippingList() {
        $sql = sprintf("SELECT distinct shippingid FROM tb_shipping_detail WHERE orderbrandid=%d", $this->id);
        $rows = $this->getDI()->get('db')->fetchAll($sql);

        $result = [];

        if(count($rows)>0) {
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
