<?php

namespace Asa\Erp;

use Phalcon\Mvc\Model;

/**
 * 订单主表
 *
 * Class TbOrder
 * @package Asa\Erp
 */
class TbOrder extends BaseModel
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
     * @var integer
     */
    public $bookingid;

    /**
     *
     * @var string
     */
    public $orderno;

    /**
     *
     * @var double
     */
    public $total;

    /**
     *
     * @var string
     */
    public $currency;

    /**
     *
     * @var string
     */
    public $bookingorderno;

    /**
     *
     * @var integer
     */
    public $isstatus;

    /**
     *
     * @var string
     */
    public $memo;

    /**
     *
     * @var integer
     */
    public $linkmanid;

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
    public $taxrebate;

    /**
     *
     * @var integer
     */
    public $bussinesstype;

    /**
     *
     * @var double
     */
    public $discount;

    /**
     *
     * @var integer
     */
    public $property;

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
    public $maketime;

    /**
     *
     * @var string
     */
    public $orderdate;

    /**
     *
     * @var string
     */
    public $genders;

    /**
     *
     * @var string
     */
    public $brandids;
    
    // 状态使用枚举存储
    // 未完成，刚刚保存状态
    const STATUS_UNFINISHED = 1;
    // 已完成
    const STATUS_FINISHED = 2;

    /**
     * 初始化
     */
    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_order');

        // 动态更新
        $this->useDynamicUpdate(true);

        // 订单-订单详情，一对多
        $this->hasMany(
            "id",
            TbOrderdetails::class,
            "orderid",
            [
                'alias' => 'orderdetails',
            ]
        );

        // 订单-订货客户，一对多反向
        $this->belongsTo(
            "bookingid",
            TbSupplier::class,
            "id",
            [
                'alias' => 'booking',
            ]
        );

        // 订单-订货币种，一对多反向
        $this->belongsTo(
            "currency",
            TbCurrency::class,
            "id",
            [
                'alias' => 'currencyModel',
            ]
        );
    }

    /**
     * 设置验证
     *
     * @return array
     */
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
     *
     * @param [type] $form 表单数据
     * @return TbOrderdetails|bool
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
     *
     * @param  [type] $form 表单数据
     * @return bool|Model [type]       [description]
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

    /**
     * 订单状态完结
     */
    function finish()
    {
        // 状态为 2 说明订单完结
        $this->status = self::STATUS_FINISHED;
        // 更新
        $this->update();
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
     * 获取该订单后查的品牌订单列表，具体走向为：客户订单 -> 品牌订单
     *
     * @return array
     */
    function getOrderbrandList()
    {
        // 获取每个品牌订单中 orderid=传过来的值，仅仅取出唯一的 orderbrandid 即可，这里也可以用groupby orderbrandid，然后查出 orderbrandid 的走向
        $sql = sprintf("SELECT distinct orderbrandid FROM tb_order_brand_detail WHERE orderid=%d", $this->id);
        $rows = $this->getDI()->get('db')->fetchAll($sql);

        $result = [];

        if (count($rows) > 0) {
            $array = [];
            foreach ($rows as $row) {
                $array[] = $row['orderbrandid'];
            }

            // 查询每个品牌订单的详细情况，并转化成数组
            $result = TbOrderBrand::find(
                sprintf("id in (%s)", implode(',', $array))
            )->toArray();
        }


        return $result;
    }
}
