<?php

namespace Asa\Erp;

/**
 * 订单主表
 * ErrorCode 1110
 */
class TbOrder extends BaseModel
{
    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_order');

        // 动态更新
        $this->useDynamicUpdate(true);

        // 订单-订单详情，一对多
        $this->hasMany(
            "id",
            "\Asa\Erp\TbOrderdetails",
            "orderid",
            [
                'alias' => 'orderdetails',
            ]
        );
    }

    public function getRules()
    {
        $factory = $this->getValidatorFactory();
        return [
            'ageseason'  => $factory->tableid('niandaijijie'),
            'supplierid' => $factory->tableid('gonghuoshang'),
        ];
    }

    /**
     * 添加一条明细数据
     * @param [type] $form 表单数据
     */
    public function addDetail($form)
    {
        $row = new TbOrderdetails();
        if ($row->create($form)) {
            return $row;
        } else {
            return false;
        }
    }

    /**
     * 更新明细数据
     * @param  [type] $form 表单数据
     * @return [type]       [description]
     */
    public function updateDetail($form)
    {
        $row = TbOrderdetails::findFirst(
            sprintf("id=%d", $form['id'])
        );

        if ($row != false && $row->companyid == $form['companyid']) {
            if ($row->update($form)) {
                return $row;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    /**
     * 获取订单明细
     */
    function getOrderDetail()
    {
        $data = [
            'form' => $this->toArray(),
            'list' => [],
        ];

        // 循环添加数据
        foreach ($this->orderdetails as $k => $orderdetail) {
            $orderdetail_array = $orderdetail->toArray();
            $orderdetail_array['product'] = $orderdetail->product->toArray();
            $data['list'][] = $orderdetail_array;
        }

        return $data;
    }

    function getDetailList()
    {
        return TbOrderdetails::find([
            sprintf("orderid=%d", $this->id),
            "order" => "productid asc",
        ]);
    }

    function finish()
    {
        $this->status = 2;
        if ($this->update() == false) {
            throw new \Exception("/11100101/订单更新失败。/");
        }
    }

    /**
     * 检查订单的详情是否已经都生成了品牌订单，如果是则将订单完成。
     * @return bool|void [type] [description]
     * @throws \Exception
     */
    function checkToFinish()
    {
        $details = $this->orderdetails;
        if (count($details) == 0) {
            return;
        }

        foreach ($this->orderdetails as $detail) {
            if ($detail->number > $detail->brand_number) {
                return false;
            }
        }

        $this->finish();
    }

    /**
     * 获取品牌订单列表
     * @return array
     */
    function getOrderbrandList()
    {
        $sql = sprintf("SELECT distinct orderbrandid FROM tb_order_brand_detail WHERE orderid=%d", $this->id);
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
}
