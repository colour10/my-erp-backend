<?php

namespace Multiple\Home\Controllers;

use Phalcon\Mvc\Controller;
use Phalcon\Mvc\View;
use Asa\Erp\TbBrandRate;

/**
 * 品牌倍率表
 */
class BrandrateController extends AdminController {
    public function initialize() {
        parent::initialize();

        $this->setModelName('Asa\\Erp\\TbBrandRate');
    }

    function getrateAction() {
        $rate = TbBrandRate::findFirst(
            sprintf("brandid=%d and ageseasonid=%d and brandgroupid=%d", $_POST['brandid'], $_POST['ageseason'], $_POST['brandgroupid'])
        );

        if($rate!=false) {
            return $this->success($rate->rate);
        }
        else {
            return $this->success("");
        }
    }
}