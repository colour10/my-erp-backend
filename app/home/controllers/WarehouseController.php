<?php

namespace Multiple\Home\Controllers;

use Asa\Erp\TbWarehouseUser;

/**
 * 仓库表
 */
class WarehouseController extends CadminController
{
    /**
     * 初始化
     */
    public function initialize()
    {
        parent::initialize();

        $this->setModelName('Asa\\Erp\\TbWarehouse');
    }

    /**
     * 获得仓库的销售员的人员列表
     *
     * @return void [type] [description]
     */
    function userlistAction()
    {
        $result = TbWarehouseUser::find(
            sprintf("userid=%d and warehouseroleid=2", $this->currentUser)
        );

        $array = [];
        foreach ($result as $key => $value) {
            $array[] = $value->warehouse->toArray();
        }

        echo $this->success($array);
    }

}
