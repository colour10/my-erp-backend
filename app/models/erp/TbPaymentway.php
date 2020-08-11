<?php

namespace Asa\Erp;

/**
 * 付款方式表
 *
 * Class TbPaymentway
 * @package Asa\Erp
 */
class TbPaymentway extends BaseModel
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
    public $name;

    /**
     *
     * @var integer
     */
    public $companyid;

    /**
     *
     * @var integer
     */
    public $displayindex;

    /**
     * 初始化
     */
    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_paymentway');
    }
}
