<?php

namespace Multiple\Home\Controllers;

/**
 * 子系列，品牌相关
 * Class Series2Controller
 * @package Multiple\Home\Controllers
 */
class Series2Controller extends ZadminController
{
    public function initialize()
    {
        parent::initialize();

        $this->setModelName('Asa\\Erp\\TbSeries2');
    }
}
        