<?php
namespace Multiple\Home\Controllers;

use Phalcon\Mvc\Controller;
use Phalcon\Mvc\View;
use Asa\Erp\ZlOccasionsstyle;

/**
 * 基础资料，场合风格表
 */
class OccasionsstyleController extends AdminController {
    public function initialize() {
	    parent::initialize();

	    $this->setModelName('Asa\\Erp\\ZlOccasionsstyle');
    }
}
