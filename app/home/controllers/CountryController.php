<?php
namespace Multiple\Home\Controllers;

use Phalcon\Mvc\Controller;
use Phalcon\Mvc\View;
use Asa\Erp\TbCountry;

/**
 * 基础资料，国家及地区信息表
 */
class CountryController extends ZadminController {
    public function initialize() {
	    parent::initialize();

	    $this->setModelName('Asa\\Erp\\TbCountry');
	    //$this->configList("code", ["name","relateid"]);
	    $this->setLanguageFlag(true);
    }
}
