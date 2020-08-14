<?php

namespace Multiple\Home\Controllers;

/**
 * 收货人信息
 * Class SupplieraddressController
 * @package Multiple\Home\Controllers
 */
class SupplieraddressController extends AdminController
{
    /**
     * 初始化
     */
    public function initialize()
    {
        parent::initialize();

        $this->setModelName('Asa\\Erp\\TbSupplierAddress');
    }
}
