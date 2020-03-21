<?php

namespace Multiple\Home\Controllers;

use Asa\Erp\TbSaleportUser;

/**
 * 销售端口表
 * Class SaleportController
 * @package Multiple\Home\Controllers
 */
class SaleportController extends CadminController
{
    public function initialize()
    {
        parent::initialize();

        $this->setModelName('Asa\\Erp\\TbSaleport');
    }

    public function listAction()
    {
        $result = TbSaleportUser::find(
            sprintf("userid=%d", $this->currentUser)
        );

        $array = [];
        foreach ($result as $key => $value) {
            $array[] = $value->saleport->toArray();
        }

        echo $this->success($array);
    }
}
