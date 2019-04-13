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

    function searchAction() {
        $conditions = [
            sprintf("companyid=%d", $this->companyid)
        ];

        if(isset($_POST["warehouseid"]) && $_POST["warehouseid"]>0) {
            $conditions[] = sprintf("warehouseid=%d", $_POST["warehouseid"]);
        }
        $result = TbProductstock::find(
            implode(" and ", $conditions)
        );
        echo $this->success($result->toArray());
    }
}
