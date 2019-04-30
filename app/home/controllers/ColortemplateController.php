<?php
namespace Multiple\Home\Controllers;

use Phalcon\Mvc\Controller;
use Phalcon\Mvc\View;
use Asa\Erp\TbColortemplate;

/**
 * 基础资料，ASA颜色模板表
 */
class ColortemplateController extends ZadminController {
    public function initialize() {
	    parent::initialize();

	    $this->setModelName('Asa\\Erp\\TbColortemplate');
    }

    function before_page() {
        $this->injectParam('__orderby', "code asc");
    }
}
