<?php

namespace Multiple\Shop\Controllers;

use Asa\Erp\TbMemberAddress;

/**
 * 会员地址控制器类
 * Class IndexController
 * @package Multiple\Shop\Controllers
 */
class MemberaddressController extends AdminController
{
    /**
     * 初始化
     */
    public function initialize()
    {
        $this->setModelName('Asa\\Erp\\TbMemberAddress');
    }

    /**
     * 单条地址展示
     * @return false|string
     */
    public function showAction()
    {
        // 逻辑
        if (!$member = $this->session->get('member')) {
            $msg = $this->getValidateMessage('model-delete-message');
            return $this->error([$msg]);
        }

        // 参数检测
        $params = $this->dispatcher->getParams();
        if (!$params || !preg_match('/^[1-9]+\d*$/', $params[0])) {
            $msg = $this->getValidateMessage('params-invalid');
            return $this->error([$msg]);
        }
        // 赋值
        $id = $params[0];
        $address = TbMemberAddress::findFirst("id=".$id." and member_id=".$member['id']);
        // 判断是否存在
        if (!$address) {
            $msg = $this->getValidateMessage('address-doesnot-exist');
            return $this->error([$msg]);
        }
        // 否则即存在，返回
        return $this->success($address->toArray());
    }


    /**
     * 地址添加
     * @return false|string
     */
    public function addAction()
    {
        // 逻辑
        if ($this->request->isPost() && $member = $this->session->get('member')) {
            // 接收参数并过滤
            $member_id = $member['id'];
            $name = $this->request->get('username', 'string');
            $tel = $this->request->get('mobile', 'int');
            $address = $this->request->get('address', 'string');
            // 非默认地址选项
            $is_default = '0';
            // 不能为空
            if (!$name || !$tel || !$address) {
                $msg = $this->getValidateMessage('fill-out-required-fields');
                return $this->error([$msg]);
            }
            // 验证手机号
            if (!preg_match("/^1[34578]\d{9}$/", $tel)) {
                $msg = $this->getValidateMessage('mobile-invalid');
                return $this->error([$msg]);
            }
            // 验证之前是否地址有重复
            // 要求memberid、username、address三者唯一
            $model = TbMemberAddress::findFirst("member_id = ".$member['id']." and name = '".$name."' and address = '".$address."'");
            if ($model) {
                $msg = $this->getValidateMessage('address-exist');
                return $this->error([$msg]);
            }
            // 如果不存在，开始执行写入逻辑
            $tbmemberaddress = new TbMemberAddress();
            if (!$tbmemberaddress->save(compact('member_id', 'name', 'tel', 'address', 'is_default'))) {
                return $this->error($tbmemberaddress);
            }
            // 最终成功
            return $this->success();
        }

    }


    /**
     * 地址编辑
     * @return false|string
     */
    public function editAction()
    {
        // 逻辑
        if ($this->request->isPost() && $member = $this->session->get('member')) {
            // 参数检测
            $params = $this->dispatcher->getParams();
            if (!$params || !preg_match('/^[1-9]+\d*$/', $params[0])) {
                $msg = $this->getValidateMessage('params-invalid');
                return $this->error([$msg]);
            }
            // 赋值
            $id = $params[0];
            $name = $this->request->get('username', 'string');
            $tel = $this->request->get('mobile', 'int');
            $address = $this->request->get('address', 'string');

            // 不能为空
            if (!$name || !$tel || !$address) {
                $msg = $this->getValidateMessage('fill-out-required-fields');
                return $this->error([$msg]);
            }
            // 验证手机号
            if (!preg_match("/^1[34578]\d{9}$/", $tel)) {
                $msg = $this->getValidateMessage('mobile-invalid');
                return $this->error([$msg]);
            }

            // 判断是否存在
            $model = TbMemberAddress::findFirst("id=".$id." and member_id=".$member['id']);
            // 如果不存在
            if (!$model) {
                $msg = $this->getValidateMessage('address-doesnot-exist');
                return $this->error([$msg]);
            }

            // 但是修改的时候不能和已经保存的其他地址重复
            $exists = TbMemberAddress::findFirst("id!=".$id." and member_id=".$member['id']." and name = '".$name."' and tel = '".$tel."' and address = '".$address."'");
            if ($exists) {
                $msg = $this->getValidateMessage('address-exist');
                return $this->error([$msg]);
            }

            // 开始修改
            if (!$model->save(compact('name', 'tel', 'address'))) {
                return $this->error($model);
            }

            // 最终成功
            return $this->success();
        }
        // 赋值
        $address = $this->showAction();
        $address_arr = json_decode($address, true);
        $this->view->setVars([
            'address' => $address_arr,
        ]);
    }


    /**
     * 地址删除
     * @return false|string
     */
    public function delAction()
    {
        // 逻辑
        if ($this->request->isPost()) {
            // 必须有member
            if ($member = $this->session->get('member')) {
                // 参数检测
                $params = $this->dispatcher->getParams();
                if (!$params || !preg_match('/^[1-9]+\d*$/', $params[0])) {
                    $msg = $this->getValidateMessage('params-invalid');
                    return $this->error([$msg]);
                }
                // 赋值
                $id = $params[0];
                // 查找是否存在该地址
                $address = TbMemberAddress::findFirst("id=".$id." and member_id=".$member['id']);
                // 如果不存在
                if (!$address) {
                    $msg = $this->getValidateMessage('address-doesnot-exist');
                    return $this->error([$msg]);
                }
                // 执行删除
                if (!$address->delete()) {
                    $msg = $this->getValidateMessage('address', 'db', 'delete-failed');
                    return $this->error([$msg]);
                }
                // 最终成功
                return $this->success();
            }
        }
    }

    /**
     * 设置默认地址
     * @return false|string
     */
    public function setdefaultAction()
    {
        // 逻辑
        if ($this->request->isPost()) {
            // 必须有member
            if ($member = $this->session->get('member')) {
                // 参数检测
                $params = $this->dispatcher->getParams();
                if (!$params || !preg_match('/^[1-9]+\d*$/', $params[0])) {
                    $msg = $this->getValidateMessage('params-invalid');
                    return $this->error([$msg]);
                }
                // 赋值
                $id = $params[0];
                // 查找是否存在该地址
                $current_address = TbMemberAddress::findFirst("id=".$id." and member_id=".$member['id']);
                // 如果不存在
                if (!$current_address) {
                    $msg = $this->getValidateMessage('address-doesnot-exist');
                    return $this->error([$msg]);
                }
                // 执行默认写入操作
                // 但同时要把其他的地址设置为非默认
                // 采用事务处理机制
                $this->db->begin();

                // 逻辑
                $addresses = TbMemberAddress::find("member_id=".$member['id']);
                foreach ($addresses as $address) {
                    // 非默认
                    $is_default = '0';
                    if (!$address->save(compact('is_default'))) {
                        // 回滚
                        $this->db->rollback();
                        $msg = $this->getValidateMessage('address', 'db', 'save-failed');
                        return $this->error([$msg]);
                    }
                }
                // 把当前地址改为默认
                $is_default = '1';
                if (!$current_address->save(compact('is_default'))) {
                    // 回滚
                    $this->db->rollback();
                    $msg = $this->getValidateMessage('address', 'db', 'save-failed');
                    return $this->error([$msg]);
                }

                // 提交事务
                $this->db->commit();

                // 最终成功
                return $this->success();
            }
        }
    }

}
