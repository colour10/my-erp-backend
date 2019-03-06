<?php
namespace Multiple\Home\Controllers;

use Phalcon\Mvc\Controller;
use Phalcon\Mvc\View;
use Asa\Erp\ZlSeries;

/**
 * 品牌系列，品牌相关数据
 */
class SeriesController extends AdminController {
    public function initialize() {
	    parent::initialize();

	    $this->setModelName('Asa\\Erp\\ZlSeries');
    }
}
