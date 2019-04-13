<?php

namespace Asa\Erp;

use Phalcon\Validation;
use Phalcon\Validation\Validator\Regex;
use Phalcon\Mvc\Model\Relation;

/**
 * 订单付款信息表
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
