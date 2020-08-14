<?php

namespace Multiple\Home\Controllers;

/**
 * 防寒指数
 * Class WinterproofingController
 * @package Multiple\Home\Controllers
 */
class WinterproofingController extends ZadminController
{
    /**
     * 初始化
     */
    public function initialize()
    {
        parent::initialize();

        $this->setModelName('Asa\\Erp\\TbWinterproofing');
    }
}
