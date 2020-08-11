<?php

namespace Asa\Erp;

/**
 * 订单明细表
 *
 * Class TbOrderdetails
 * @package Asa\Erp
 */
class TbOrderdetails extends BaseModel
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
    public $orderid;

    /**
     *
     * @var integer
     */
    public $sizecontentid;

    /**
     *
     * @var integer
     */
    public $number;

    /**
     *
     * @var integer
     */
    public $productid;

    /**
     *
     * @var integer
     */
    public $currencyid;

    /**
     *
     * @var double
     */
    public $price;

    /**
     *
     * @var integer
     */
    public $confirm_number;

    /**
     *
     * @var integer
     */
    public $companyid;

    /**
     *
     * @var string
     */
    public $createdate;

    /**
     *
     * @var integer
     */
    public $status;

    /**
     *
     * @var double
     */
    public $discount;

    /**
     *
     * @var integer
     */
    public $shipping_number;

    /**
     *
     * @var integer
     */
    public $brand_number;

    /**
     *
     * @var double
     */
    public $factoryprice;

    /**
     *
     * @var double
     */
    public $wordprice;

    /**
     * 初始化
     */
    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_orderdetails');

        // 订单详情-商品主表，一对多反向
        $this->belongsTo(
            'productid',
            TbProduct::class,
            'id',
            [
                'alias' => 'product',
            ]
        );

        // 订单详情-商品尺码表，一对多反向
        $this->belongsTo(
            'sizecontentid',
            TbSizecontent::class,
            'id',
            [
                'alias' => 'sizecontent',
            ]
        );

        // 订单详情-商品主表，一对多反向
        $this->belongsTo(
            'orderid',
            TbOrder::class,
            'id',
            [
                'alias' => 'order',
            ]
        );
    }
}
