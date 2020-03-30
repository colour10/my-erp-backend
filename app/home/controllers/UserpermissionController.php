<?php

namespace Multiple\Home\Controllers;

use Asa\Erp\TbUserPermission;

/**
 * 用户权限控制器
 * Class PermissionactionController
 * @package Multiple\Home\Controllers
 */
class UserpermissionController extends ZadminController
{
    public function initialize()
    {
        parent::initialize();

        $this->setModelName('Asa\\Erp\\TbUserPermission');
    }

    /**
     * 初始化用户权限表，这个表是后来建立的，数据为空，所以需要先从其他的表把数据导过来
     */
    public function initAction()
    {
        // 初始化
        $user = new UserController();
        $permissions = $user->grouppermissionsAction();
        // 开始遍历
        // 采用事务处理，并且在写入之前先清空数据表
        $this->db->begin();
        $this->db->query("truncate table tb_user_permission");
        foreach ($permissions as $permission) {
            $user_id = $permission['user_id'];
            // 再继续遍历 $permission['groupPermissions']
            foreach ($permission['groupPermissions'] as $groupPermission) {
                $model = new TbUserPermission();
                $model->userid = $user_id;
                $model->groupid = $groupPermission['groupid'];
                $model->permissionid = $groupPermission['permissionid'];
                if (!$model->save()) {
                    $this->db->rollback();
                }
            }
        }
        $this->db->commit();
        echo $this->success('初始化tb_user_permission表成功');
    }
}
