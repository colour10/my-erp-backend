<?php

namespace Asa\Erp;

/**
 * 商品价格表
 *
 * Class TbProductPrice
 * @package Asa\Erp
 */
class TbProductPrice extends BaseModel
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
    public $productid;

    /**
     *
     * @var integer
     */
    public $priceid;

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
    public $updatestaff;

    /**
     *
     * @var string
     */
    public $updatetime;

    /**
     * 初始化
     */
    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_product_price');
    }
}
