<?php

namespace Multiple\Home\Controllers;

/**
 * 基础资料，商品尺寸表
 * Class UlnarinchController
 * @package Multiple\Home\Controllers
 */
class UlnarinchController extends ZadminController
{
    public function initialize()
    {
        parent::initialize();

        $this->setModelName('Asa\\Erp\\TbUlnarinch');
    }

    function before_page()
    {
        $_POST["__orderby"] = "displayindex asc";
    }
}
