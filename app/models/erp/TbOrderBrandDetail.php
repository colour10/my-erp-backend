<?php

namespace Asa\Erp;

/**
 * 品牌订单明细
 */
class TbOrderBrandDetail extends BaseModel
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
    public $orderbrandid;

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
    public $orderdetailid;

    /**
     *
     * @var integer
     */
    public $orderid;

    /**
     *
     * @var integer
     */
    public $shipping_number;

    /**
     *
     * @var double
     */
    public $discount;

    /**
     *
     * @var double
     */
    public $factoryprice;

    /**
     *
     * @var integer
     */
    public $currencyid;

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
        $this->setSource('tb_order_brand_detail');
    }
}
