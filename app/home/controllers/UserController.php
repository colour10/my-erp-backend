<?php

namespace Multiple\Home\Controllers;

use Asa\Erp\TbSaleport;
use Asa\Erp\TbUser;
use Asa\Erp\TbUserPermission;
use Exception;

/**
 * 用户表控制器
 * Class UserController
 * @package Multiple\Home\Controllers
 */
class UserController extends CadminController
{
    public function initialize()
    {
        parent::initialize();

        $this->setModelName('Asa\\Erp\\TbUser');
    }

    function modifypasswordAction()
    {
        if ($this->request->isPost()) {
            $result = ["code" => 200, "messages" => []];
            echo json_encode($result);
        }
    }

    function deletegroupAction()
    {
        $this->doEdit();
    }


    public function beforeExecuteRoute($dispatcher)
    {
        // 这个方法会在每一个能找到的action前执行
        $action = $dispatcher->getActionName();
        if ($action === "edit" || $action == 'add') {

            if (isset($_POST["password"]) && !preg_match("#^[0-9a-z]{32}$#", $_POST["password"])) {
                //echo $_POST["password"];exit;
                $_POST["password"] = md5($_POST["password"]);
            }
        }
    }

    /**
     * 取出当前用户的所属权限组模型
     * @return false|string
     */
    public function groupAction()
    {
        // 判断是否返回了正确的结果
        $user = $this->modelAction();
        // 如果是string，说明是json，则原样返回
        if (gettype($user) == 'string') {
            return $user;
        } else {
            return json_encode($user->group);
        }
    }

    /**
     * 取出当前用户的所属公司部门模型
     * @return false|string
     */
    public function departmentAction()
    {
        // 逻辑
        // 判断是否返回了正确的结果
        $user = $this->modelAction();
        // 如果是string，说明是json，则原样返回
        if (gettype($user) == 'string') {
            return $user;
        } else {
            return json_encode($user->department);
        }
    }

    /**
     * 取出当前用户的所属公司模型
     * @return false|string
     */
    public function companyAction()
    {
        // 逻辑
        // 判断是否返回了正确的结果
        $user = $this->modelAction();
        // 如果是string，说明是json，则原样返回
        if (gettype($user) == 'string') {
            return $user;
        } else {
            return json_encode($user->department->company);
        }
    }

    /**
     * 取出当前用户的所属国家模型
     * @return false|string
     */
    public function countryAction()
    {
        // 逻辑
        // 判断是否返回了正确的结果
        $user = $this->modelAction();
        // 如果是string，说明是json，则原样返回
        if (gettype($user) == 'string') {
            return $user;
        } else {
            return json_encode($user->department->company->country);
        }
    }

    /**
     * 获取当前用户模型
     * @return false|string
     */
    public function modelAction()
    {
        // 逻辑
        $session_user = $this->session->get('user');
        if (!$session_user) {
            $msg = $this->getValidateMessage('model-delete-message');
            return $this->error([$msg]);
        }
        // 查找当前登录用户的模型
        $user = TbUser::findFirstById($session_user['id']);
        if (!$user) {
            $msg = $this->getValidateMessage('user', 'template', 'notexist');
            return $this->error([$msg]);
        }
        // 返回正确的结果
        return $user;
    }

    /**
     * 获取当前登录用户的销售端口
     * @return false|string [type] [description]
     */
    function saleportlistAction()
    {
        $auth = $this->auth;
        if ($auth['saleportids'] != "") {
            $result = TbSaleport::find(
                sprintf("id in (%s)", $auth['saleportids'])
            );

            return $this->success($result->toArray());
        } else {
            return $this->success();
        }
    }

    /**
     * 获取某个用户的销售端口，这个用户必须是当前公司的才能操作
     *
     * @return false|string [type] [description]
     */
    function currentsaleportlistAction()
    {
        // 必须存在userId
        if (!$userId = $this->request->getPost('userId')) {
            return $this->error($this->di->get("staticReader")->label('make-an-error'));
        }

        // 查找
        // 如果不存在，返回空
        if (!$user = TbUser::findFirst([
            'conditions' => 'id = :userId: and companyid = :companyid:',
            'bind'       => [
                'userId'    => $userId,
                'companyid' => $this->companyid,
            ],
        ])) {
            return $this->success();
        }

        // 存在则继续处理
        $user_array = $user->toArray();
        // 如果没有销售端口
        if ($user_array['saleportids'] == "") {
            return $this->success();
        }

        // 存在则继续
        $result = TbSaleport::find(
            sprintf("id in (%s)", $user_array['saleportids'])
        );
        return $this->success($result->toArray());
    }

    /**
     * 个人设置自己的默认端口号、仓库和价格
     * @return false|string [type] [description]
     * @throws Exception
     */
    function settingAction()
    {
        return $this->success($this->currentUser);

        $user = TbUser::findFirstById($this->currentUser);
        if ($user != false) {
            $user->saleportid = $_POST['saleportid'];
            $user->priceid = $_POST['priceid'];
            $user->warehouseid = $_POST['warehouseid'];
            if ($user->update()) {
                return $this->success();
            }
        }

        throw new Exception("/11140101/个人信息设置失败。/");
    }

    /**
     * 获取所有用户的权限组和权限信息，用作初始化使用
     */
    public function grouppermissionsAction()
    {
        $users = TbUser::find();
        $return = [];
        foreach ($users as $user) {
            $return[] = [
                'user_id'          => $user->id,
                'group'            => empty($user->group) ? [] : $user->group->toArray(),
                'groupPermissions' => empty($user->group->permissionGroups) ? [] : $user->group->permissionGroups->toArray(),
            ];
        }
        // 返回
        return $return;
    }

    /**
     * 获取当前用户的权限信息，从 userpermission 表中获取最新权限
     */
    public function currentpermissionsAction()
    {
        if ($this->request->isPost()) {
            $return = [];
            if ($user = TbUser::findFirstById($this->request->getPost('user_id'))) {
                $return = [
                    'user_id'          => $user->id,
                    'group'            => empty($user->group) ? [] : $user->group->toArray(),
                    'groupPermissions' => empty($user->userpermissions) ? [] : $user->userpermissions->toArray(),
                ];
            }
            // 返回
            echo $this->success($return);
        }
    }


    /**
     * 给单用户分配权限, 注意，每个用户的最高权限不能超过用户权限组的，需要做判断
     * @return false|string
     * @throws Exception
     */
    public function permissionsettingAction()
    {
        // 提取参数
        $user = TbUser::findFirstById($_POST['userid']);
        // 必须是同公司的才能修改
        if ($user != false && $user->companyid == $this->companyid) {
            // 首先拿到当前权限组的所有权限
            $groupPermissions = $user->group->permissionGroups->toArray();
            $keys = explode(",", $_POST['keys']);
            $permissionids = array_column($groupPermissions, 'permissionid');

            // 判断 keys 是否为 $permissionids 的子集
            if (!empty($keys) && $keys != array_intersect($keys, $permissionids)) {
                echo $this->error($this->di->get("staticReader")->label('permission-exceed'));
                exit;
            }

            // 开始写入操作
            $this->db->begin();
            foreach ($user->userpermissions as $row) {
                if ($row->delete() == false) {
                    $this->db->rollback();
                    throw new Exception('/1002/用户清除旧权限失败/');
                }
            }

            foreach ($keys as $permissionid) {
                // 如果 $permissionid 为空，说明用户没有分配任何权限，那么就设置 permissionid 为0
                $userPermission = new TbUserPermission();
                $userPermission->userid = $_POST['userid'];
                $userPermission->groupid = $user->groupid;
                $userPermission->permissionid = (int)$permissionid;
                if ($userPermission->create() == false) {
                    $this->db->rollback();
                    throw new Exception('/1002/用户设置权限失败/');
                }
            }

            $this->db->commit();
            return $this->success();
        } else {
            throw new Exception('/1002/用户不存在。/');
        }
    }

    /**
     * 给多用户分配权限, 注意，每个用户的最高权限不能超过用户权限组的，需要做判断
     * @return false|string
     * @throws Exception
     */
    public function multipermissionsettingAction()
    {
        // 提取参数
        // 如果不存在，则报非法操作
        if (!isset($_POST['userIds']) || !isset($_POST['keys'])) {
            throw new Exception('非法操作');
        }

        // 用户id列表
        $userIds = explode(',', $_POST['userIds']);
        // 开始写入操作
        $this->db->begin();
        foreach ($userIds as $userId) {
            // 必须是同公司的才能修改
            $user = TbUser::findFirstById($userId);
            if ($user != false && $user->companyid == $this->companyid) {
                // 首先拿到当前权限组的所有权限
                $groupPermissions = $user->group->permissionGroups->toArray();
                $keys = explode(",", $_POST['keys']);
                $permissionids = array_column($groupPermissions, 'permissionid');

                // 判断 keys 是否为 $permissionids 的子集
                if (!empty($keys) && $keys != array_intersect($keys, $permissionids)) {
                    echo $this->error($this->di->get("staticReader")->label('permission-exceed'));
                    exit;
                }

                foreach ($user->userpermissions as $row) {
                    if ($row->delete() == false) {
                        $this->db->rollback();
                        throw new Exception('/1002/用户清除旧权限失败/');
                    }
                }

                foreach ($keys as $permissionid) {
                    // 如果 $permissionid 为空，说明用户没有分配任何权限，那么就设置 permissionid 为0
                    $userPermission = new TbUserPermission();
                    $userPermission->userid = $userId;
                    $userPermission->groupid = $user->groupid;
                    $userPermission->permissionid = (int)$permissionid;
                    if ($userPermission->create() == false) {
                        $this->db->rollback();
                        throw new Exception('/1002/用户设置权限失败/');
                    }
                }
            } else {
                throw new Exception('/1002/用户不存在。/');
            }
        }
        $this->db->commit();
        return $this->success();
    }

    /**
     * 取出某个用户的信息
     *
     * @return false|string
     */
    public function showAction()
    {
        // 必须存在userId
        if (!$userId = $this->request->getPost('userId')) {
            return $this->error($this->di->get("staticReader")->label('make-an-error'));
        }

        // 查找 userId 对应的仓库记录
        if ($user = TbUser::findFirst([
            'conditions' => 'id = :userId:',
            'bind'       => [
                'userId' => $userId,
            ],
        ])) {
            $user = $user->toArray();
        } else {
            $user = [];
        }

        // 返回
        return $this->success($user);
    }
}
