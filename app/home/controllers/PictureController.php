<?php
namespace Multiple\Home\Controllers;

use Phalcon\Mvc\Controller;
use Phalcon\Mvc\View;
use Asa\Erp\TbPicture;

class PictureController extends ZadminController {    
    public function initialize() {
	    parent::initialize();
	    
	    $this->setModelName('Asa\\Erp\\TbPicture');
    }
}
