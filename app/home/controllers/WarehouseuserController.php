<?php

namespace Multiple\Home\Controllers;

use Asa\Erp\TbWarehouseUser;

/**
 * 仓库表
 * Class WarehouseUserController
 * @package Multiple\Home\Controllers
 */
class WarehouseUserController extends CadminController
{
    /**
     * 初始化
     */
    public function initialize()
    {
        parent::initialize();

        $this->setModelName('Asa\\Erp\\TbWarehouseUser');
    }

    /**
     * 取出当前用户的仓库列表
     *
     * @return false|string
     */
    public function listAction()
    {
        // 必须存在userId
        if (!$userId = $this->request->getPost('userId')) {
            return $this->error($this->di->get("staticReader")->label('make-an-error'));
        }

        // 查找 userId 对应的仓库记录
        // 如果不存在，返回空
        if (!$warehouses = TbWarehouseUser::find([
            'conditions' => 'userid = :userId:',
            'bind'       => [
                'userId' => $userId,
            ],
        ])) {
            return $this->success();
        }

        // 存在则继续处理
        $warehouses_array = $warehouses->toArray();
        foreach ($warehouses as $k => $warehouse) {
            // 仓库名称
            $warehouses_array[$k]['warehousename'] = $warehouse->warehouse->name;
            // 角色名称
            $warehouses_array[$k]['warehouserolename'] = $warehouse->warehouseroleid == TbWarehouseUser::ROLE_MANAGER ? $this->di->get("staticReader")->get('warehouserole', TbWarehouseUser::ROLE_MANAGER) : $this->di->get("staticReader")->get('warehouserole', TbWarehouseUser::ROLE_SELLER);
        }

        // 返回
        return $this->success($warehouses_array);
    }
}
