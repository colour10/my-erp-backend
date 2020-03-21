<?php

namespace Asa\Erp;

/**
 * 付款方式表
 */
class TbPaymentway extends BaseModel
{
    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_paymentway');
    }
}
