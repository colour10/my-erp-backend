<?php
namespace Multiple\Home\Controllers;

use Phalcon\Mvc\Controller;
use Phalcon\Mvc\View;
use Asa\Erp\ZlProducttemplate;

/**
 * 基础资料，商品尺码描述主表
 */
class ProducttemplateController extends ZadminController {
    public function initialize() {
	    parent::initialize();

	    $this->setModelName('Asa\\Erp\\ZlProducttemplate');
    }
}
