<?php
namespace Multiple\Home\Controllers;

use Phalcon\Mvc\Controller;
use Phalcon\Mvc\View;
use Asa\Erp\TbTemplatemanage;

/**
 * 基础资料，商品尺码描述子表
 */
class TemplatemanageController extends ZadminController {
    public function initialize() {
	    parent::initialize();

	    $this->setModelName('Asa\\Erp\\TbTemplatemanage');
    }
}
