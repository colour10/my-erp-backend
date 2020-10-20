<?php

namespace Asa\Erp;

use Phalcon\Mvc\Model;

/**
 * 销售单主表
 * ErrorCode 1108
 * @property int $id 主键id
 * @property int|null $memberid 会员ID
 * @property int|null $salesstaff 销售人员ID
 * @property string|null $salesdate 销售日期
 * @property float|null $discount 折扣
 * @property int|null $saleportid 销售端口id
 * @property int $companyid 公司id
 * @property string|null $ordercode 对账单号
 * @property int|null $warehouseid 销售仓库id
 * @property string|null $expressno 快递单号
 * @property bool|null $expresspaidtype 0-预付 1-到付 2-第三方付费 3-储值卡 4-转账 5-协议结算
 * @property float|null $expressfee 快递费用
 * @property bool $status 1-预售 2-已售 3-作废
 * @property string|null $address 地址
 * @property string|null $externalno 外部订单号
 * @property bool|null $pickingtype 0-自提 1-快递 2-门店直发
 * @property int $makestaff 制单人
 * @property null $makedate 制单日期
 * @property string $orderno 订单号
 * @property int|null $priceid 价格id
 * @property-read TbSalesdetails|null $salesdetails 订单详情
 * @property-read TbSaleport|null $saleport 销售端口
 * @property-read TbWarehouse|null $warehouse 仓库
 */
class TbSales extends BaseModel
{
    /**
     * 初始化
     */
    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_sales');

        // 订单-订单详情，一对多
        $this->hasMany(
            "id",
            TbSalesdetails::class,
            "salesid",
            [
                'alias' => 'salesdetails',
            ]
        );

        // 订单-销售端口，一对多反向
        $this->belongsTo(
            'saleportid',
            TbSaleport::class,
            'id',
            [
                'alias' => 'saleport',
            ]
        );

        // 订单-仓库，一对多反向
        $this->belongsTo(
            'warehouseid',
            TbWarehouse::class,
            'id',
            [
                'alias' => 'warehouse',
            ]
        );
    }

    /**
     * 添加一条明细数据
     *
     * @param [type] $form 表单数据
     * @return TbSalesdetails
     * @throws \Exception
     */
    public function addDetail($form)
    {
        $row = new TbSalesdetails();
        if ($row->create($form)) {
            return $row;
        } else {
            throw new \Exception("/11080101/添加销售明细失败/");
        }
    }

    /**
     * 更新明细数据
     *
     * @param  [type] $form 表单数据
     * @return Model [type]       [description]
     * @throws \Exception
     */
    public function updateDetail($form)
    {
        $row = TbSalesdetails::findFirst(
            sprintf("id=%d", $form['id'])
        );

        if ($row != false) {
            if ($row->update($form)) {
                return $row;
            } else {
                throw new \Exception("/11080201/销售明细更新失败。/");
            }
        } else {
            throw new \Exception("/11080202/销售明细不存在。/");
        }
    }

    function getOrderDetail()
    {
        $data = [
            'form' => $this->toArray(),
            'list' => [],
        ];

        // 循环添加数据
        foreach ($this->salesdetails as $k => $detail) {
            $orderdetail_array = $detail->toArray();
            $productstock = $detail->productstock;

            /*  $orderdetail_array['productname'] = $productstock->product->productname;
              $orderdetail_array['sizecontentid'] = $productstock->sizecontentid;
              $orderdetail_array['price'] = $productstock->goods->price;*/
            $orderdetail_array['productstock'] = $detail->productstock->toArray();
            $data['list'][] = $orderdetail_array;
        }

        return $data;
    }
}
