<?php

namespace Asa\Erp;

use Phalcon\Validation;
use Phalcon\Validation\Validator\Regex;
use Phalcon\Mvc\Model\Relation;

/**
 * 销售单收款信息表
 */
class TbSalesReceive extends BaseModel
{
    /**
     * 初始化
     */
    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_sales_receive');
    }
}