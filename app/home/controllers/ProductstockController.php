<?php

namespace Multiple\Home\Controllers;

use Phalcon\Mvc\Controller;
use Phalcon\Mvc\View;
use Asa\Erp\TbProductstock;

/**
 * 库存表
 */
class ProductstockController extends AdminController {
    public function initialize() {
        parent::initialize();

        $this->setModelName('Asa\\Erp\\TbProductstock');
    }

    /**
     * 实际可用库存
     */
    public function availableAction()
    {

    }

    /**
     * 预售库存
     */
    public function presaleAction()
    {

    }

    /**
     * 调拨锁定库存
     */
    public function requisitionAction()
    {

    }

    /**
     * 在途库存
     */
    public function intransitAction()
    {

    }
}
