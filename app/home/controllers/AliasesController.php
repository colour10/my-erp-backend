<?php
namespace Multiple\Home\Controllers;

use Phalcon\Mvc\Controller;
use Phalcon\Mvc\View;
use Asa\Erp\ZlAliases;

class AliasesController extends ZadminController {    
    public function initialize() {
	    parent::initialize();
	    
	    $this->setModelName('Asa\\Erp\\ZlAliases');
    }
}
