<?php

namespace Asa\Erp;

/**
 * 订单付款信息表
 * Class TbOrderPayment
 * @package Asa\Erp
 */
class TbOrderPayment extends BaseModel
{
    /**
     * 初始化
     */
    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_order_payment');
    }
}
