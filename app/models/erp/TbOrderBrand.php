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

    function getOrderList() {
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
    }
}
