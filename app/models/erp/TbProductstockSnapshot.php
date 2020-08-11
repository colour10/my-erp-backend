<?php

namespace Asa\Erp;

/**
 * 库存快照表
 *
 * Class TbProductstockSnapshot
 * @package Asa\Erp
 */
class TbProductstockSnapshot extends BaseModel
{
    /**
     *
     * @var integer
     */
    public $id;

    /**
     *
     * @var string
     */
    public $snapdate;

    /**
     *
     * @var integer
     */
    public $productstockid;

    /**
     *
     * @var integer
     */
    public $productid;

    /**
     *
     * @var integer
     */
    public $sizeid;

    /**
     *
     * @var integer
     */
    public $stockid;

    /**
     *
     * @var integer
     */
    public $productno;

    /**
     *
     * @var string
     */
    public $selltime;

    /**
     *
     * @var double
     */
    public $sellprice;

    /**
     *
     * @var double
     */
    public $cost;

    /**
     *
     * @var integer
     */
    public $selltype;

    /**
     *
     * @var double
     */
    public $dealprice;

    /**
     *
     * @var integer
     */
    public $qualitystatus;

    /**
     *
     * @var integer
     */
    public $sellstaff;

    /**
     *
     * @var integer
     */
    public $corderid;

    /**
     *
     * @var integer
     */
    public $currencyid;

    /**
     *
     * @var string
     */
    public $memo;

    /**
     *
     * @var string
     */
    public $cpdate;

    /**
     *
     * @var string
     */
    public $intime;

    /**
     *
     * @var string
     */
    public $property;

    /**
     *
     * @var string
     */
    public $kpflag;

    /**
     *
     * @var integer
     */
    public $decadeid;

    /**
     * 初始化
     */
    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_productstock_snapshot');
    }
}
