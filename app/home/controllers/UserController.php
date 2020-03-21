<?php

namespace Multiple\Home\Controllers;

use Asa\Erp\TbSaleport;
use Asa\Erp\TbUser;
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
     * 个人设置自己的默认端口号、仓库和价格
     * @return false|string [type] [description]
     * @throws Exception
     */
    function settingAction()
    {
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
}
