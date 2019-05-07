<?php
namespace Multiple\Home\Controllers;

use Phalcon\Mvc\Controller;
use Phalcon\Mvc\View;

/**
 * 支持多国语言版本的表的基类
 */
class ZadminController extends AdminController {   
    public function initialize() {
	    parent::initialize();
    }
    
    function indexAction() {
    }
}
