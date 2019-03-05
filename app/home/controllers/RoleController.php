<?php
namespace Multiple\Home\Controllers;

use Phalcon\Mvc\Controller;
use Demo\SysStudent;

class RoleController extends AdminController
{

	public function initialize()
    {
        parent::initialize();
        $this->setModelName('Demo\\SysStudent');
    }
    
    function addAction() {
        $this->doAdd();
    }
    
    function editAction() {
        $this->doAdd();
    }
}
