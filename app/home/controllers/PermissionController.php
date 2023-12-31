<?php

namespace Multiple\Home\Controllers;

use Asa\Erp\TbPermission;
use Asa\Erp\Util;

/**
 * 权限表，这个控制器在页面不体现出来，所以只录入就可以了
 * Class PermissionController
 * @package Multiple\Home\Controllers
 */
class PermissionController extends ZadminController
{
    public function initialize()
    {
        parent::initialize();

        $this->setModelName('Asa\\Erp\\TbPermission');
    }

    function before_edit($row)
    {
        $this->check();
    }

    function before_add()
    {
        $this->check();
    }

    function before_delete($row)
    {
        $this->check();
    }

    function before_page()
    {
        $this->check();

        $_POST["__orderby"] = "pid asc, display_index asc";
    }

    private function check()
    {
        if ($this->config->mode != 'develop') {
            throw new \Exception("/11170101/内部错误/");
        }
    }

    /**
     * 获取权限目录树
     * 特别说明：权限理论上无限级，但是因为前段部分页面绑定了二级分类的名字，而提交的时候，如果当前分类下还有子分类，那么发送过来的 keys 只能包含它的下级分类的id，这样的话就会影响菜单的正常显示了。
     * @return false|string
     */
    public function treeAction()
    {
        // 逻辑
        $permissions = TbPermission::find([
            "is_only_superadmin=0",
            "order" => "display_index asc",
        ]);
        if (!$permissions) {
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

        // 交给下面的格式化为目录树处理并返回
        return $this->success(Util::format_tree($permissions_array));
    }
}
