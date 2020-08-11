<?php

namespace Asa\Erp;

/**
 * 商品条目表
 *
 * Class TbGoods
 * @package Asa\Erp
 */
class TbGoods extends BaseModel
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
    public $sizecontentid;

    /**
     *
     * @var integer
     */
    public $defective_level;

    /**
     *
     * @var integer
     */
    public $property;

    /**
     *
     * @var string
     */
    public $change_time;

    /**
     *
     * @var integer
     */
    public $change_stuff;

    /**
     *
     * @var double
     */
    public $price;

    /**
     *
     * @var integer
     */
    public $companyid;

    /**
     * 初始化
     */
    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_goods');
    }
}
