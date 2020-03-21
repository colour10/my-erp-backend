<?php

namespace Multiple\Home\Controllers;

/**
 * 价格定义表
 * Class PriceController
 * @package Multiple\Home\Controllers
 */
class PriceController extends CadminController
{
    public function initialize()
    {
        parent::initialize();

        $this->setModelName('Asa\\Erp\\TbPrice');
    }

    function before_page()
    {
        $_POST["__orderby"] = "displayindex asc";
    }
}
