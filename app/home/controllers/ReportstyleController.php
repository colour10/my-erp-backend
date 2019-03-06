<?php
namespace Multiple\Home\Controllers;

use Phalcon\Mvc\Controller;
use Asa\Erp\ZlExReportstyle;

class ReportstyleController extends AdminController
{

	public function initialize()
    {
        parent::initialize();
        $this->setModelName('Asa\\Erp\\ZlExReportstyle');
    }
    
    function addAction() {
        $this->doAdd();
    }
    
    function editAction() {
        $this->doEdit();
    }
}
