<?php
namespace Multiple\Home\Controllers;

use Phalcon\Mvc\Controller;
use Phalcon\Mvc\View;
use Asa\Erp\TbMaterial;

/**
 * 基础资料，材质表
 */
class MaterialController extends ZadminController {
    public function initialize() {
	    parent::initialize();

	    $this->setModelName('Asa\\Erp\\TbMaterial');
    }

    function before_page() {
        $_POST["__orderby"] = "code asc";
    }
}
