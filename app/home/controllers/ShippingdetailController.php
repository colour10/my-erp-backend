<?php

namespace Multiple\Home\Controllers;

/**
 * 发货单明细表
 * Class ShippingdetailController
 * @package Multiple\Home\Controllers
 */
class ShippingdetailController extends AdminController
{
    public function initialize()
    {
        parent::initialize();

        $this->setModelName('Asa\\Erp\\TbShippingDetail');
    }
}
