<?php
namespace Multiple\Home\Controllers;

use Phalcon\Mvc\Controller;
use Phalcon\Mvc\View;
use Asa\Erp\ZlCountry;

/**
 * 基础资料，国家及地区信息表
 */
class CountryController extends AdminController {
    public function initialize() {
	    parent::initialize();

	    $this->setModelName('Asa\\Erp\\ZlCountry');
	    $this->configList("code", ["name","code"]);
    }
}
