<?php

namespace Multiple\Shop\Controllers;

use Asa\Erp\TbMemberAddress;
use Phalcon\Http\Response;
use Phalcon\Http\ResponseInterface;

/**
 * 会员地址控制器类
 * Class MemberaddressController
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
     * 列表页，必须登录才能访问
     * @return Response|ResponseInterface|void
     */
    public function indexAction()
    {
        // 验证是否登录
        if (!$member = $this->member) {
            return $this->response->redirect('/login');
        }

        // 取出当前登录用户的地址列表
        $result = TbMemberAddress::find("member_id = " . $member['id']);
        $this->view->setVar("result", $result->toArray());
    }


    /**
     * 地址添加
     * @return false|string|void
     */
    public function addAction()
    {
        // 逻辑
        // 如果是post提交
        if ($this->request->isPost() && $member = $this->member) {
            // 接收参数并过滤
            $member_id = $member['id'];
            $name = $this->request->get('username', 'string');
            $tel = $this->request->get('mobile', 'int');
            $address = $this->request->get('address', 'string');
            // 默认地址选项，如果当前用户一个地址也没有保存，那么就设置为默认，否则为非默认
            $is_default = TbMemberAddress::count("member_id=" . $member_id) ? 0 : 1;
            // 不能为空
            if (!$name || !$tel || !$address) {
                return $this->error($this->getValidateMessage('fill-out-required-fields'));
            }
            // 验证手机号
            if (!preg_match("/^1[34578]\d{9}$/", $tel)) {
                return $this->error($this->getValidateMessage('mobile-invalid'));
            }
            // 验证之前是否地址有重复
            // 要求memberid、username、address三者唯一
            $model = TbMemberAddress::findFirst("member_id = " . $member['id'] . " and name = '" . $name . "' and address = '" . $address . "'");
            if ($model) {
                return $this->error($this->getValidateMessage('address-exist'));
            }
            // 如果不存在，开始执行写入逻辑
            $tbmemberaddress = new TbMemberAddress();
            if (!$tbmemberaddress->save(compact('member_id', 'name', 'tel', 'address', 'is_default'))) {
                return $this->error($tbmemberaddress);
            }
            // 最终成功
            return $this->success();
        }

        // 如果是get请求
        if (!$member = $this->member) {
            return $this->response->redirect('/login');
        }
    }


    /**
     * 地址编辑
     * @return false|string|void
     */
    public function editAction()
    {
        // 逻辑
        if ($this->request->isPost() && $member = $this->member) {
            // 赋值
            $params = $this->dispatcher->getParams();
            $id = $params[0];
            $name = $this->request->get('username');
            $tel = $this->request->get('mobile');
            $address = $this->request->get('address');

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

            // 验证地址是否存在
            $addressModel = $this->checkIfExistsAddress();
            if (is_string($addressModel)) {
                return $this->error($addressModel);
            }

            // 但是修改的时候不能和已经保存的其他地址重复
            $exists = TbMemberAddress::findFirst("id!=" . $id . " and member_id=" . $member['id'] . " and name = '" . $name . "' and tel = '" . $tel . "' and address = '" . $address . "'");
            if ($exists) {
                return $this->error($this->getValidateMessage('address-exist'));
            }

            // 开始修改
            if (!$addressModel->save(compact('name', 'tel', 'address'))) {
                return $this->error($addressModel);
            }

            // 最终成功
            return $this->success();
        }
        // 赋值
        $address = $this->checkIfExistsAddress();

        // 如果是字符串，说明是错误提示，那么就直接返回
        if (is_string($address)) {
            // 传递错误
            return $this->renderError('make-an-error', $address);
        }
        $this->view->setVars([
            'address' => $address->toArray(),
        ]);
    }


    /**
     * 地址删除
     * @return false|string|void
     */
    public function delAction()
    {
        // 逻辑
        if ($this->request->isPost() && $member = $this->member) {
            // 验证地址是否存在
            $addressModel = $this->checkIfExistsAddress();
            if (is_string($addressModel)) {
                return $this->error($addressModel);
            }

            // 执行删除
            if (!$addressModel->delete()) {
                return $this->error($this->getValidateMessage('address', 'db', 'delete-failed'));
            }
            // 最终成功
            return $this->success();
        }
    }

    /**
     * 设置默认地址
     * @return false|string|void
     */
    public function setdefaultAction()
    {
        // 逻辑
        if ($this->request->isPost() && $member = $this->member) {
            // 验证地址是否存在
            $addressModel = $this->checkIfExistsAddress();
            if (is_string($addressModel)) {
                return $this->error($addressModel);
            }

            // 执行默认写入操作
            // 但同时要把其他的地址设置为非默认
            // 采用事务处理机制
            $this->db->begin();

            // 逻辑
            $addresses = TbMemberAddress::find("member_id=" . $member['id']);
            foreach ($addresses as $address) {
                // 非默认
                $is_default = '0';
                if (!$address->save(compact('is_default'))) {
                    // 回滚
                    $this->db->rollback();
                    return $this->error($this->getValidateMessage('address', 'db', 'save-failed'));
                }
            }
            // 把当前地址改为默认
            $is_default = '1';
            if (!$addressModel->save(compact('is_default'))) {
                // 回滚
                $this->db->rollback();
                return $this->error($this->getValidateMessage('address', 'db', 'save-failed'));
            }

            // 提交事务
            $this->db->commit();

            // 最终成功
            return $this->success();
        }
    }


    /**
     * 检查地址是否合法
     * @return array|string
     */
    private function checkIfExistsAddress()
    {
        // 逻辑
        // 参数检测
        $params = $this->dispatcher->getParams();
        if (!$params || !preg_match('/^[1-9]+\d*$/', $params[0])) {
            return $this->getValidateMessage('params-error');
        }

        // 查找地址是否存在
        $address = TbMemberAddress::findFirst([
            "id = :id: and member_id = :member_id:",
            'bind' => [
                'id'        => $params[0],
                'member_id' => $this->member['id'],
            ],
        ]);
        // 判断是否存在
        if (!$address) {
            return $this->getValidateMessage('address-doesnot-exist');
        }
        // 返回地址对象
        return $address;
    }

}
