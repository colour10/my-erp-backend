<?php
namespace Multiple\Home\Controllers;

use Phalcon\Mvc\Controller;
use Asa\Erp\ZlWashinginstructions;

class WashinginstructionsController extends ZadminController
{

	public function initialize()
    {
        parent::initialize();
        $this->setModelName('Asa\\Erp\\ZlWashinginstructions');
    }
    
    function addAction() {
        $this->doAdd();
    }
    
    function editAction() {
        $this->doEdit();
    }
}
