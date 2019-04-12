<?php
namespace Multiple\Home\Controllers;

use Phalcon\Mvc\Controller;
use Phalcon\Mvc\View;
use Asa\Erp\TbWarehouse;
use Asa\Erp\TbWarehouseUser;
/**
 * 仓库表
 */
class WarehouseController extends CadminController {
    public function initialize() {
	    parent::initialize();

	    $this->setModelName('Asa\\Erp\\TbWarehouse');
    }

    /**
     * 获得仓库的销售员的人员列表
     * @return [type] [description]
     */
    function userlistAction() {
        $result = TbWarehouseUser::find(
            sprintf("userid=%d and warehouseroleid=2", $this->currentUser)
        );

        $array = [];
        foreach ($result as $key => $value) {
           // print_r($value->toArray());
            $array[] = $value->warehouse->toArray();
        }

        echo $this->success($array);
    }
}
