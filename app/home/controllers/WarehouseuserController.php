<?php

namespace Multiple\Home\Controllers;

/**
 * 仓库表
 * Class WarehouseUserController
 * @package Multiple\Home\Controllers
 */
class WarehouseUserController extends CadminController
{
    public function initialize()
    {
        parent::initialize();

        $this->setModelName('Asa\\Erp\\TbWarehouseUser');
    }
}
