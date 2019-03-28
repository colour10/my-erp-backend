<?php
namespace Multiple\Home\Controllers;

use Phalcon\Mvc\Controller;
use Asa\Erp\ZlExecutioncategory;

class ExecutioncategoryController extends AdminController
{

	public function initialize()
    {
        parent::initialize();
        $this->setModelName('Asa\\Erp\\ZlExecutioncategory');
    }
    
    function addAction() {
        $this->doAdd();
    }
    
    function editAction() {
        $this->doEdit();
    }
}
