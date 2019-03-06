<?php
namespace Multiple\Home\Controllers;

use Phalcon\Mvc\Controller;
use Phalcon\Mvc\View;
use Asa\Erp\ZlUlnarinch;

/**
 * 基础资料，商品尺寸表
 */
class UlnarinchController extends AdminController {
    public function initialize() {
	    parent::initialize();

	    $this->setModelName('Asa\\Erp\\ZlUlnarinch');
    }
}
