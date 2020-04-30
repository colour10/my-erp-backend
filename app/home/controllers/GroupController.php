<?php

namespace Multiple\Home\Controllers;

use Asa\Erp\TbGroup;
use Asa\Erp\TbPermissionGroup;
use Exception;

/**
 * 分组表
 * Class GroupController
 * @package Multiple\Home\Controllers
 */
class GroupController extends CadminController
{
    public function initialize()
    {
        parent::initialize();

        $this->setModelName('Asa\\Erp\\TbGroup');
    }

    /**
     * 给组分配权限
     * @return false|string
     * @throws Exception
     */
    public function settingAction()
    {
        // 提取参数
        $group = TbGroup::findFirstById($_POST['groupid']);
        if ($group != false && $group->companyid == $this->companyid) {
            $this->db->begin();
            foreach ($group->permissionGroups as $row) {
                if ($row->delete() == false) {
                    $this->db->rollback();
                    throw new Exception('/1002/权限组清除就权限失败/');
                }
            }

            $keys = explode(",", $_POST['keys']);
            foreach ($keys as $permissionid) {
                $permissionGroup = new TbPermissionGroup();
                $permissionGroup->groupid = $group->id;
                $permissionGroup->permissionid = (int)$permissionid;
                if ($permissionGroup->create() == false) {
                    $this->db->rollback();
                    throw new Exception('/1002/权限组设置权限失败/');
                }
            }

            $this->db->commit();
            return $this->success();
        } else {
            throw new Exception('/1002/权限组不存在。/');
        }
    }

    /**
     * 获得组的权限列表
     * @return false|string [type] [description]
     * @throws Exception
     */
    function getpermissionsAction()
    {
        $group = TbGroup::findFirstById($_POST['groupid']);
        if ($group != false && $group->companyid == $this->companyid) {
            return $this->success($group->permissionGroups->toArray());
        } else {
            throw new Exception('/1002/权限组不存在。/');
        }
    }

    /**
     * 当前公司下所有的权限组列表
     *
     * @return false|string
     */
    public function currentlistAction()
    {
        // 逻辑
        return $this->success(TbGroup::find([
            'conditions' => 'companyid = :companyid:',
            'columns'    => 'id, group_name',
            'bind'       => [
                'companyid' => $this->companyid,
            ],
        ]));
    }
}
