<?php
namespace Multiple\Home\Controllers;

use Phalcon\Mvc\Controller;
use Phalcon\Mvc\View;
class BaseController extends Controller {
	public function initialize() {
	    //parent::initialize();
	    
        //ÓïÑÔÑ¡Ïî
        //print_r($this->config);
        $language = $this->config->language;
        $system_language = new \Phalcon\Config\Adapter\Php(APP_PATH . "/app/config/languages/{$language}.php");
        //print_r($system_language);exit;
        $this->view->setVar("system_language", $system_language);
    }
}
