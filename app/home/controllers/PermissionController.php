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
     * 增加模型，方便录入测试
     * 因为postman录入有bug，所以重写了此方法
     * @return false|string|void
     */
    public function addAction()
    {
        if($this->request->isPost()) {
            //更新数据库
            $row = $this->getModelObject();
            $fields = $this->getAttributes();
            foreach($fields as $name) {
                // postman录入只能用原生的request获取
                if($this->request->get($name)) {
                    $row->$name = $this->request->get($name);
                }
            }

            $result = array("code"=>200, "messages" => array());
            if ($row->create() === false) {
                $messages = $row->getMessages();

                foreach ($messages as $message) {
                    $result["messages"][] = $message->getMessage();
                }
            } else {
                $result['is_add'] = "1";
                $result['id'] = $row->id;
            }

            echo json_encode($result);
            $this->view->disable();
        }
    }


    /**
     * 获取权限目录树
     * @return false|string
     */
    public function treeAction()
    {
        // 逻辑
        $permissions = TbPermission::find([
            'sys_delete_flag' => '0'
        ]);
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
        return json_encode(Util::format_tree($permissions_array));
    }
}
