<?php

namespace Multiple\Home\Controllers;

/**
 * 海关销售单位表
 *
 * Class CustomsunitController
 * @package Multiple\Home\Controllers
 */
class CustomsunitController extends AdminController
{
    /**
     * 初始化
     */
    public function initialize()
    {
        parent::initialize();

        $this->setModelName('Asa\\Erp\\TbCustomsUnit');
    }
}
