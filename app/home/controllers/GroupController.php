<?php

namespace Multiple\Home\Controllers;

use Phalcon\Mvc\Controller;
use Phalcon\Mvc\View;
use Asa\Erp\TbGroup;
use Asa\Erp\Util;
use Asa\Erp\TbPermissionGroup;

/**
 * 分组表
 */
class GroupController extends AdminController {
    public function initialize() {
        parent::initialize();

        $this->setModelName('Asa\\Erp\\TbGroup');
    }

    /**
     * 给组分配权限
     * @return false|string
     */
    public function settingAction()
    {
        // 逻辑
        if($this->request->isPost()) {
            // 提取参数
            // 判断groupid不能为空
            if (!$this->request->get('groupid')) {
                return $this->error(['groupid is required']);
            }
            $groupid = $this->request->get('groupid');
            $keys = $this->request->get('keys');
            // 验证合法性
            $pattern = '/^[1-9]+(,\d)*$/';
            if (!preg_match($pattern, $keys)) {
                return $this->error(['keys is invalid']);
            }
            // 转为数组
            $keys_arr = Util::char_to_array($keys);

            // 开始分配权限
            // 首先清除原来的权限分配记录(查询条件为：公司id：$auth->company,groupid:$groupid,sys_delete_flag:0)
            $user = $this->session->get('user');
            $companyid = $user['companyid'];
            $result = TbPermissionGroup::find("groupid=$groupid and companyid=$companyid and sys_delete_flag=0");

            foreach ($result as $record) {
                // 如果存在，就删除
                if (!$record->delete()) {
                    return $this->error(['Permission delete failed']);
                }
            }

            // 开始分配新的权限
            foreach ($keys_arr as $permissionid) {
                // 判断原纪录是否有软删除，如果有软删除则不必重新创建
                $result = TbPermissionGroup::findFirst("groupid=$groupid and companyid=$companyid and permissionid=$permissionid and sys_delete_flag=1");
                if ($result) {
                    // 如果存在，就把1改为0，即启用
                    // 删除相关字段留空
                    $data = [
                        'sys_delete_flag' => '0',
                        'sys_delete_stuff' => NULL,
                        'sys_delete_date' => NULL,
                    ];
                    if (!$result->save($data)) {
                        return $this->error(['Permission save failed']);
                    }
                } else {
                    // 开始新建权限，一定要在里面新建模型，保证插入的准确性
                    $TbPermissionGroup = new TbPermissionGroup();
                    $data = [
                        'groupid' => $groupid,
                        'companyid' => $companyid,
                        'permissionid' => $permissionid,
                        'sys_delete_flag' => '0',
                    ];
                    if (!$TbPermissionGroup->save($data)) {
                        return $this->error(['Permission insert failed']);
                    }
                }
            }
            // 返回最终分配好的权限目录树
            $group = TbGroup::findFirstById($groupid);
            return $group->permissions();
        }
    }
}
