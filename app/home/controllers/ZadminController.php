<?php
namespace Multiple\Home\Controllers;

use Phalcon\Mvc\Controller;
use Phalcon\Mvc\View;

/**
 * 支持多国语言版本的表的基类
 */
class ZadminController extends AdminController {
    protected $default_language = "cn";
    
    public function initialize() {
	    parent::initialize();
    }
    
    function indexAction() {
    }

    function getModelObject() {
        $model = parent::getModelObject();
        $model->setValidateLanguage(isset($_REQUEST['lang']) ? $_REQUEST['lang'] : $this->default_language);

        return $model;
    }
    
    function before_edit($row) {
        $row->setValidateLanguage(isset($_REQUEST['lang']) ? $_REQUEST['lang'] : $this->default_language);
    }
}
