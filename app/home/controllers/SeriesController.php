<?php
namespace Multiple\Home\Controllers;

use Phalcon\Mvc\Controller;
use Phalcon\Mvc\View;
use Asa\Erp\TbSeries;

/**
 * 品牌系列，品牌相关数据
 */
class SeriesController extends CadminController {
    public function initialize() {
	    parent::initialize();

	    $this->setModelName('Asa\\Erp\\TbSeries');
    }

    function before_page() {
        $_POST["__orderby"] = "displayindex asc";
        $_POST["name_en"] = strtoupper($_POST["name_en"]);
    }

   function before_add() {
        $_POST["name_en"] = strtoupper($_POST["name_en"]);
        $_POST["companyid"] = $this->companyid;
    }
}
