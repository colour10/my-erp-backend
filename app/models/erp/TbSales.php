<?php

namespace Asa\Erp;

use Phalcon\Mvc\Model;

/**
 * 销售单主表
 * ErrorCode 1108
 */
class TbSales extends BaseModel
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
    public $memberid;

    /**
     *
     * @var integer
     */
    public $salesstaff;

    /**
     *
     * @var string
     */
    public $salesdate;

    /**
     *
     * @var double
     */
    public $discount;

    /**
     *
     * @var integer
     */
    public $saleportid;

    /**
     *
     * @var integer
     */
    public $companyid;

    /**
     *
     * @var string
     */
    public $ordercode;

    /**
     *
     * @var integer
     */
    public $warehouseid;

    /**
     *
     * @var string
     */
    public $expressno;

    /**
     *
     * @var integer
     */
    public $expresspaidtype;

    /**
     *
     * @var double
     */
    public $expressfee;

    /**
     *
     * @var integer
     */
    public $status;

    /**
     *
     * @var string
     */
    public $address;

    /**
     *
     * @var string
     */
    public $externalno;

    /**
     *
     * @var integer
     */
    public $pickingtype;

    /**
     *
     * @var integer
     */
    public $makestaff;

    /**
     *
     * @var string
     */
    public $makedate;

    /**
     *
     * @var string
     */
    public $orderno;

    /**
     *
     * @var integer
     */
    public $priceid;

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
