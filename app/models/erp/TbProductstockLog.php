<?php

namespace Asa\Erp;

/**
 * 库存日志表
 * Class TbProductstockLog
 * @package Asa\Erp
 */
class TbProductstockLog extends BaseModel
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
    public $warehouseid;

    /**
     *
     * @var integer
     */
    public $productstockid;

    /**
     *
     * @var integer
     */
    public $number_before;

    /**
     *
     * @var integer
     */
    public $number_after;

    /**
     *
     * @var integer
     */
    public $change_type;

    /**
     *
     * @var string
     */
    public $change_time;

    /**
     *
     * @var integer
     */
    public $relationid;

    /**
     *
     * @var integer
     */
    public $companyid;

    /**
     *
     * @var integer
     */
    public $change_stuff;

    /**
     * 初始化
     */
    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_productstock_log');
    }
}
