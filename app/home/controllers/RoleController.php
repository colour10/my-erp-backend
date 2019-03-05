<?php
namespace Multiple\Home\Controllers;

use Phalcon\Mvc\Controller;
use Asa\Erp\Role;

class RoleController extends AdminController
{

	public function initialize()
    {
        parent::initialize();
        $this->setModelName('Asa\\Erp\\Role');
    }
    
    function addAction() {
        $this->doAdd();
    }
    
    function editAction() {
        $this->doEdit();
    }
}
