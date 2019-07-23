<?php
namespace Multiple\Home\Controllers;

use Phalcon\Mvc\Controller;
use Phalcon\Mvc\View;
use Asa\Erp\TbSaleType;

/**
 * 销售属性表
 */
class SaletypeController extends AdminController {
    public function initialize() {
	    parent::initialize();

	    $this->setModelName('Asa\\Erp\\TbSaleType');
    }

    function before_page() {
        $_POST["__orderby"] = "displayindex asc";
    }
}
