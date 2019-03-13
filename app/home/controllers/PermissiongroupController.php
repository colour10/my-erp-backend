<?php
namespace Multiple\Home\Controllers;

use Asa\Erp\Util;
use Phalcon\Mvc\Controller;
use Phalcon\Mvc\View;
use Asa\Erp\TbPermissionGroup;
use Asa\Erp\TbGroup;

/**
 * 组权限表
 */
class PermissiongroupController extends CadminController {
    public function initialize() {
	    parent::initialize();

	    $this->setModelName('Asa\\Erp\\TbPermissionGroup');
    }
}
