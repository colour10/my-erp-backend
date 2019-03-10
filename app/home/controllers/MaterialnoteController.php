<?php
namespace Multiple\Home\Controllers;

use Phalcon\Mvc\Controller;
use Phalcon\Mvc\View;
use Asa\Erp\ZlMaterialnote;

/**
 * 基础资料，材质备注表
 */
class MaterialnoteController extends ZadminController {
    public function initialize() {
	    parent::initialize();

	    $this->setModelName('Asa\\Erp\\ZlMaterialnote');
    }
}
