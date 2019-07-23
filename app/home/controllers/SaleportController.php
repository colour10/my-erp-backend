<?php
namespace Multiple\Home\Controllers;

use Phalcon\Mvc\Controller;
use Phalcon\Mvc\View;
use Asa\Erp\TbSaleport;
use Asa\Erp\TbSaleportUser;
/**
 * 销售端口表
 */
class SaleportController extends CadminController {
    public function initialize() {
        parent::initialize();

        $this->setModelName('Asa\\Erp\\TbSaleport');
    }

    public function listAction() {
        $result = TbSaleportUser::find(
            sprintf("userid=%d", $this->currentUser)
        );

        $array = [];
        foreach ($result as $key => $value) {
           // print_r($value->toArray());
            $array[] = $value->saleport->toArray();
        }

        echo $this->success($array);
    }
}
