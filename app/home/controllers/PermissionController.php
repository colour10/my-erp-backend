<?php
namespace Multiple\Home\Controllers;

use Phalcon\Mvc\Controller;
use Phalcon\Mvc\View;
use Asa\Erp\TbPermission;
use Asa\Erp\Util;

/**
 * 权限表，这个控制器在页面不体现出来，所以只录入就可以了
 */
class PermissionController extends AdminController {
    public function initialize() {
        parent::initialize();

        $this->setModelName('Asa\\Erp\\TbPermission');
    }

    /**
     * 获取权限目录树
     * @return false|string
     */
    public function treeAction()
    {
        // 逻辑
        $permissions = TbPermission::find("is_only_superadmin=0");
        if(!$permissions) {
            return $this->error(['permissions are not exist']);
        }

        // 处理pid字段
        $permissions_array = $permissions->toArray();
        // 加入up_dp_id字段和remark字段，和部门表的判断字段保持一致
        foreach ($permissions_array as $k => $permission) {
            $permissions_array[$k]['up_dp_id'] = $permission['pid'];
            $permissions_array[$k]['remark'] = $permission['memo_cn'];
            $permissions_array[$k]['memo'] = $permission['memo_cn'];
            // 保持label为中文，需要传递中文说明
            $permissions_array[$k]['name'] = $permission['memo_cn'];
        }

        // return json_encode($permissions_array);

        // 交给下面的格式化为目录树处理并返回
        return $this->success(Util::format_tree($permissions_array));
    }
}
