<?php

namespace Multiple\Home\Controllers;

/**
 * 属性定义表
 * Class PropertyController
 * @package Multiple\Home\Controllers
 */
class PropertyController extends AdminController
{
    public function initialize()
    {
        parent::initialize();

        $this->setModelName('Asa\\Erp\\TbProperty');
    }

    function before_page()
    {
        $_POST["__orderby"] = "displayindex asc";
    }
}
