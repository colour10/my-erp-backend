<?php

namespace Multiple\Home\Controllers;

/**
 * 关系单位信息，供货商表
 * Class SupplierController
 * @package Multiple\Home\Controllers
 */
class SupplierController extends AdminController
{
    public function initialize()
    {
        parent::initialize();

        $this->setModelName('Asa\\Erp\\TbSupplier');
    }
}
