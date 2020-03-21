<?php

namespace Multiple\Home\Controllers;

/**
 * 防寒指数
 * Class WinterproofingController
 * @package Multiple\Home\Controllers
 */
class WinterproofingController extends ZadminController
{
    public function initialize()
    {
        parent::initialize();

        $this->setModelName('Asa\\Erp\\TbWinterproofing');
    }
}
