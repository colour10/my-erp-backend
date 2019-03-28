<?php

namespace Multiple\Home\Controllers;

use Phalcon\Mvc\Controller;
use Phalcon\Mvc\View;
use Asa\Erp\TbProductstock;

/**
 * 库存表
 */
class ProductstockController extends BaseController {
    public function initialize() {
        parent::initialize();
    }

    function pageAction() {
        $result = TbProductstock::find(
            sprintf("companyid=%d", $this->companyid)
        );
        echo $this->success($result->toArray());
    }
}
