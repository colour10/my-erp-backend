<?php

namespace Multiple\Home\Controllers;

/**
 * 销售属性表
 * Class SaletypeController
 * @package Multiple\Home\Controllers
 */
class SaletypeController extends AdminController
{
    public function initialize()
    {
        parent::initialize();

        $this->setModelName('Asa\\Erp\\TbSaleType');
    }

    function before_page()
    {
        $_POST["__orderby"] = "displayindex asc";
    }
}
