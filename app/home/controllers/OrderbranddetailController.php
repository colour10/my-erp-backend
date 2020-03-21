<?php

namespace Multiple\Home\Controllers;

/**
 * 品牌订单明细
 * Class OrderbranddetailController
 * @package Multiple\Home\Controllers
 */
class OrderbranddetailController extends AdminController
{
    public function initialize()
    {
        parent::initialize();

        $this->setModelName('Asa\\Erp\\TbOrderBrandDetail');
    }
}
