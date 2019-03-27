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
class GroupController extends CadminController {
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
            if (!$this->request->get('id')) {
                $msg = $this->getValidateMessage('groupid', 'template', 'required');
                return $this->error([$msg]);
            }
            $groupid = $this->request->get('id');
            $keys = $this->request->get('keys');
            // 验证keys合法性
            $pattern = '/^[1-9]+(,\d)*$/';
            if (!preg_match($pattern, $keys)) {
                $msg = $this->getValidateMessage('group-keys', 'template', 'invalid');
                return $this->error([$msg]);
            }
            // 转为数组
            $keys_arr = Util::char_to_array($keys);

            // 开始分配权限
            // 首先清除原来的权限分配记录(查询条件为：公司id：$auth->company,groupid:$groupid)
            $user = $this->session->get('user');
            $companyid = $user['companyid'];
            $result = TbPermissionGroup::find("groupid=$groupid and companyid=$companyid");

            foreach ($result as $record) {
                // 如果存在，就删除
                if (!$record->delete()) {
                    $msg = $this->getValidateMessage('permission', 'db', 'delete-failed');
                    return $this->error([$msg]);
                }
            }

            // 开始分配新的权限
            foreach ($keys_arr as $permissionid) {
                // 开始新建权限，一定要在里面新建模型，保证插入的准确性
                $TbPermissionGroup = new TbPermissionGroup();
                $data = [
                    'groupid' => $groupid,
                    'companyid' => $companyid,
                    'permissionid' => $permissionid
                ];
                if (!$TbPermissionGroup->save($data)) {
                    $msg = $this->getValidateMessage('permission', 'db', 'add-failed');
                    return $this->error([$msg]);
                }
            }
            // 返回最终分配好的权限目录树
            $group = TbGroup::findFirstById($groupid);
            return $group->permissions();
        }
    }
}
