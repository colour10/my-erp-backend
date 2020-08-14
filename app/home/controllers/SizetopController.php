<?php

namespace Multiple\Home\Controllers;

/**
 * 商品尺码信息
 * Class SizetopController
 * @package Multiple\Home\Controllers
 */
class SizetopController extends ZadminController
{
    /**
     * 初始化
     */
    public function initialize()
    {
        parent::initialize();

        $this->setModelName('Asa\\Erp\\TbSizetop');
    }

    /**
     * 分页前调用
     */
    function before_page()
    {
        $_POST["__orderby"] = "displayindex asc";
    }
}
