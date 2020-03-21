<?php

namespace Multiple\Home\Controllers;

/**
 * 商品尺码信息
 * Class SizetopController
 * @package Multiple\Home\Controllers
 */
class SizetopController extends ZadminController
{
    public function initialize()
    {
        parent::initialize();

        $this->setModelName('Asa\\Erp\\TbSizetop');
    }

    function before_page()
    {
        $_POST["__orderby"] = "displayindex asc";
    }
}
