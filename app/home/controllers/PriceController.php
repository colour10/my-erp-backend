<?php
namespace Multiple\Home\Controllers;

use Phalcon\Mvc\Controller;
use Phalcon\Mvc\View;
use Asa\Erp\TbPrice;

/**
 * 价格定义表
 */
class PriceController extends CadminController {
    public function initialize() {
	    parent::initialize();

	    $this->setModelName('Asa\\Erp\\TbPrice');
    }

    function before_page() {
        $_POST["__orderby"] = "displayindex asc";
    }
}
