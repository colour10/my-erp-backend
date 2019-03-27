<?php
namespace Multiple\Shop\Controllers;

use Phalcon\Mvc\Controller;
use Asa\Erp\ZlBrandgroup;

class BrandgroupController extends AdminController
{

	public function initialize()
    {
        $this->setModelName('Asa\\Erp\\ZlBrandgroup');
    }

    public function indexAction()
    {

    }
}
