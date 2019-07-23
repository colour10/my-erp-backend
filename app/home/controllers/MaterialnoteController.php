<?php
namespace Multiple\Home\Controllers;

use Phalcon\Mvc\Controller;
use Phalcon\Mvc\View;
use Asa\Erp\TbMaterialnote;

/**
 * 材质备注
 */
class MaterialnoteController extends ZadminController {
    public function initialize() {
	    parent::initialize();

	    $this->setModelName('Asa\\Erp\\TbMaterialnote');
    }

    function before_page() {
        $_POST["__orderby"] = "displayindex asc";
    }
}
