<?php
namespace Multiple\Shop\Controllers;

use Phalcon\Mvc\Controller;
use Phalcon\Mvc\View;
use Asa\Erp\ZlBrand;

class ProductController extends AdminController {
    public function initialize() {
        $this->setModelName('Asa\\Erp\\TbProduct');
    }

    public function detailAction()
    {

    }
}
