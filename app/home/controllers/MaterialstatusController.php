<?php
namespace Multiple\Home\Controllers;

use Phalcon\Mvc\Controller;
use Phalcon\Mvc\View;
use Asa\Erp\ZlMaterialstatus;

/**
 * 基础资料，材质状态表
 */
class MaterialstatusController extends ZadminController {
    public function initialize() {
	    parent::initialize();

	    $this->setModelName('Asa\\Erp\\ZlMaterialstatus');
    }
}
