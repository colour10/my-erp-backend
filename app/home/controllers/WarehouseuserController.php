<?php
namespace Multiple\Home\Controllers;

use Phalcon\Mvc\Controller;
use Phalcon\Mvc\View;
use Asa\Erp\TbWarehouse;
use Asa\Erp\TbWarehouseUser;
/**
 * 仓库表
 */
class WarehouseUserController extends CadminController {
    public function initialize() {
	    parent::initialize();

	    $this->setModelName('Asa\\Erp\\TbWarehouseUser');
    }
}
