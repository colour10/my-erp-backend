<?php
namespace Multiple\Home\Controllers;

use Phalcon\Mvc\Controller;
use Asa\Erp\Warehouse;

class WarehouseController extends AdminController
{

	public function initialize()
    {
        parent::initialize();
        $this->setModelName('Asa\\Erp\\Warehouse');
    }
    
    function addAction() {
        $this->doAdd();
    }
    
    function editAction() {
        $this->doEdit();
    }
}
