<?php
namespace Multiple\Home\Controllers;

use Phalcon\Mvc\Controller;
use Phalcon\Mvc\View;
use Asa\Erp\TbPermissionModule;

/**
 * 基础资料，权限-模型多对多表
 */
class PermissionmoduleController extends PermissionController {
    public function initialize() {
        parent::initialize();

        $this->setModelName('Asa\\Erp\\TbPermissionModule');
    }
}
