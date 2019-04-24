<?php
namespace Multiple\Home\Controllers;

use Phalcon\Mvc\Controller;
use Phalcon\Mvc\View;
use Asa\Erp\TbUlnarinch;

/**
 * 基础资料，商品尺寸表
 */
class UlnarinchController extends ZadminController {
    public function initialize() {
	    parent::initialize();

	    $this->setModelName('Asa\\Erp\\TbUlnarinch');
    }

    function before_page() {
        $_POST["__orderby"] = "displayindex asc";
    }
}
