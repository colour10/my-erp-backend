<?php

namespace Multiple\Home\Controllers;

use Asa\Erp\TbAgeseason;
use Asa\Erp\TbBrand;
use Asa\Erp\TbBrandgroup;
use Asa\Erp\TbDepartment;
use Asa\Erp\TbGroup;
use Asa\Erp\TbManager;
use Asa\Erp\TbMember;
use Asa\Erp\TbPermission;
use Asa\Erp\TbPermissionGroup;
use Asa\Erp\TbProduct;
use Asa\Erp\TbSeries;
use Asa\Erp\TbUser;
use Asa\Erp\TbCompany;
use Asa\Erp\Util;

/**
 * 超级管理员表
 */
class ManagerController extends AdminController
{
    public function initialize()
    {
        parent::initialize();

        $this->setModelName('Asa\\Erp\\TbManager');
    }

    /**
     * 超级管理员登录页面，并初始化
     */
    public function loginAction()
    {
        // 逻辑
        if ($this->request->isPost()) {
            // 验证数据
            $login_name = $this->request->get('login_name');
            $password = $this->request->get('password');

            if (!$login_name || !$password) {
                return $this->error('请填写所有必填字段');
            }

            // 查找记录
            $rs = TbManager::findFirst([
                "login_name = :login_name: and password = :password:",
                'bind' => [
                    'login_name' => $login_name,
                    'password' => md5($password),
                ],
            ]);

            // 判断是否成功
            if ($rs) {
                // 加入session
                $this->session->set('manager', $rs->toArray());
                return $this->success();
            } else {
                return $this->error('登录失败');
            }
        }

        // 调取默认模板
        if ($this->session->has('manager')) {
            return $this->dispatcher->forward(['controller' => 'manager', 'action' => 'set']);
        }
        $this->mview->partial('manager/login');
    }

    /**
     * 登录之后的默认欢迎页面
     */
    public function welcomeAction()
    {
        // 逻辑
        $this->mview->partial('manager/welcome');
    }

    /**
     * 一键设置公司信息
     * @return false|\Phalcon\Http\Response|\Phalcon\Http\ResponseInterface|string
     */
    public function setAction()
    {
        // 逻辑
        if ($this->request->isPost() && $this->session->has('manager')) {
            // 验证数据
            // 如果语言为空，那么就赋值为cn
            if (!$this->session->has('language')) {
                $this->session->set('language', 'cn');
            }
            // 默认公司名称
            $company = $this->request->get('company');
            // 管理员名称
            $admin = $this->request->get('admin');
            // 默认部门，可以考虑放开，这里不用数组以保持外部录入的兼容性
            $department = $this->request->get('department') ?: '人力资源部,财务部,销售部,技术部';
            // 默认分组，这个是权限分配组
            $groups = ['管理员组', '普通用户组'];

            if (!$company || !$admin || !$department) {
                return $this->error('请填写所有必填字段');
            }

            // 采用事务处理
            $this->db->begin();
            // 如果公司存在，则报错
            if ($rs = TbCompany::findFirst([
                "name = :name:",
                'bind' => [
                    'name' => trim($company),
                ],
            ])) {
                $this->db->rollback();
                return $this->error('公司名已存在');
            }

            // 如果不报错，则开始添加
            // 添加公司
            $companyModel = new TbCompany();
            $data = ['name' => trim($company)];
            if (!$companyModel->create($data)) {
                $this->db->rollback();
                return $this->error('公司名创建失败');
            }

            // 新公司id
            $companyid = $companyModel->id;

            // 创建管理员组，这个是分配权限用的
            foreach ($groups as $group) {
                // 如果不存在，则创建
                if (!$groupModel = TbGroup::findFirst("group_name='$group' AND companyid=$companyid")) {
                    $groupModel = new TbGroup();
                    $data = ['group_name' => $group, 'companyid' => $companyid];
                    if (!$groupModel->create($data)) {
                        $this->db->rollback();
                        return $this->error($group . '创建失败');
                    }
                }
                // 管理员组id
                if ($group == '管理员组') {
                    $groupid = $groupModel->id;
                }
            }

            // 添加默认部门
            // 分割为数组
            // 默认departmentid为null
            $departmentid = NULL;
            foreach (explode(',', $department) as $k => $v) {
                if (TbDepartment::findFirst("name='$v' AND companyid=$companyid and up_dp_id=0")) {
                    $this->db->rollback();
                    return $this->error('部门名称' . $v . '重复，创建失败');
                }
                $departmentModel = new TbDepartment();
                $data = ['name' => $v, 'companyid' => $companyid, 'up_dp_id' => 0];
                if (!$departmentModel->create($data)) {
                    $this->db->rollback();
                    return $this->error('部门创建失败');
                }
                // 如果当前操作的是技术部，那么就记录下它的id
                if ($v == '技术部') {
                    $departmentid = $departmentModel->id;
                }
            }

            // 添加管理员
            // 如果管理员存在，就循环写入
            if ($rs = TbUser::findFirst([
                "login_name = :login_name:",
                'bind' => [
                    'login_name' => trim($admin),
                ],
            ])) {
                // 开始循环写入
                while (true) {
                    $username = trim($admin) . mt_rand(1000, 9999);
                    // 如果找不到就直接添加
                    if (!$rs = TbUser::findFirst([
                        "login_name = :login_name:",
                        'bind' => [
                            'login_name' => $username,
                        ],
                    ])) {
                        // 添加公司管理员
                        $userModel = new TbUser();
                        $data = ['login_name' => $username, 'password' => md5($admin . '123'), 'companyid' => $companyid, 'groupid' => $groupid, 'departmentid' => $departmentid];
                        if (!$userModel->create($data)) {
                            $this->db->rollback();
                            return $this->error('用户名创建失败');
                        }
                        // 成功就跳出循环
                        break;
                    }
                }
            } else {
                // 如果管理员不存在，则直接添加
                // 添加公司管理员
                $userModel = new TbUser();
                // groupid暂时设置为2
                $data = ['login_name' => trim($admin), 'password' => md5($admin . '123'), 'companyid' => $companyid, 'groupid' => $groupid, 'departmentid' => $departmentid];
                if (!$userModel->create($data)) {
                    $this->db->rollback();
                    return $this->error('用户名创建失败');
                }
            }

            // 给所属的权限组添加权限
            // 管理员组所属的权限是所有
            $permissions = TbPermission::find("is_only_superadmin=0");
            // 首先清除所有已经设置的权限
            $pgs = TbPermissionGroup::find("groupid=$groupid");
            foreach ($pgs as $pg) {
                if (!$pg->delete()) {
                    $this->db->rollback();
                    return $this->error('原有的权限删除失败');
                }
            }
            // 新增权限
            foreach ($permissions as $permission) {
                $pgmodel = new TbPermissionGroup();
                $data = ['groupid' => $groupid, 'permissionid' => $permission->id];
                if (!$pgmodel->create($data)) {
                    $this->db->rollback();
                    return $this->error('权限创建失败');
                }
            }

            // 提交
            $this->db->commit();

            // 返回成功
            return $this->success();
        }

        // 调取默认模板
        if (!$this->session->has('manager')) {
            return $this->dispatcher->forward(['controller' => 'manager', 'action' => 'login']);
        }
        $this->mview->partial('manager/set');
    }

    /**
     * 退出登录
     */
    public function logoutAction()
    {
        // 逻辑
        $this->session->destroy('manager');
        return $this->response->redirect('manager/login');
    }

    /**
     * 统计功能，该做模板循环了
     */
    public function statisAction()
    {
        // 逻辑
        // 寻找是否存在名为“虚拟公司”的公司
        if (!$companyModel = TbCompany::findFirst("name='虚拟公司'")) {
            $companyModel = new TbCompany();
            if (!$companyModel->create([
                'name' => '虚拟公司',
            ])) {
                return false;
            }
        }

        // 取出虚拟公司id
        $companydid = $companyModel->id;

        // 开始统计
        $companys = TbCompany::find("id != " . $companydid);
        $datas = [];
        $total_members_count = 0;
        $total_users_count = 0;
        $total_products_count = 0;
        foreach ($companys as $k => $company) {
            // 用户表
            $users = TbUser::find("companyid = " . $company->id);
            // 取出用户表一些关键信息，部门，组，公司
            // 保存最后的结果
            $return_users = [];
            // 循环遍历
            foreach ($users->toArray() as $j => $user) {
                $departmentModel = TbDepartment::findFirstById($user['departmentid']);
                $groupModel = TbGroup::findFirstById($user['groupid']);
                $companyModel = TbCompany::findFirstById($user['companyid']);
                $user['departmentname'] = $departmentModel ? $departmentModel->name : '';
                $user['groupname'] = $groupModel ? $groupModel->group_name : '';
                $user['companyname'] = $companyModel ? $companyModel->name : '';
                // 如果有为null，则赋值为空
                foreach (array_keys($user) as $key) {
                    if (is_null($user[$key])) {
                        $user[$key] = '';
                    }
                }
                // 重新赋值
                $return_users[$j] = $user;
            }

            // 会员表
            $members = TbMember::find("companyid = " . $company->id);
            // 保存最后的结果
            $return_members = [];
            // 循环遍历
            foreach ($members->toArray() as $i => $member) {
                $companyModel = TbCompany::findFirstById($member['companyid']);
                $member['companyname'] = $companyModel ? $companyModel->name : '';

                // 性别
                switch ($member['gender']) {
                    case '0':
                        $gender = '女士';
                        break;
                    case '1':
                        $gender = '男士';
                        break;
                    case '2':
                        $gender = '中性';
                        break;
                    default:
                        $gender = '';
                }
                $member['gendername'] = $gender;

                // 如果有为null，则赋值为空
                foreach (array_keys($member) as $key) {
                    if (is_null($member[$key])) {
                        $member[$key] = '';
                    }
                }
                // 重新赋值
                $return_members[$i] = $member;
            }

            // 产品表
            $products = TbProduct::find("companyid = " . $company->id);
            // 保存最后的结果，年代、性别、品牌、品类
            $return_products = [];
            // 循环遍历
            foreach ($products->toArray() as $l => $product) {
                // 系列
                $seriesModel = TbSeries::findFirstById($product['series']);
                $product['seriesname'] = $seriesModel ? $seriesModel->name_cn : '';
                // 公司名
                $companyModel = TbCompany::findFirstById($product['companyid']);
                $product['companyname'] = $companyModel ? $companyModel->name : '';
                // 品牌
                $brandModel = TbBrand::findFirstById($product['brandid']);
                $product['brandname'] = $brandModel ? $brandModel->name_cn : '';
                // 品类
                $brandgroupModel = TbBrandgroup::findFirstById($product['brandgroupid']);
                $product['brandgroupname'] = $brandgroupModel ? $brandgroupModel->name_cn : '';
                // 性别
                switch ($product['gender']) {
                    case '0':
                        $gender = '女士';
                        break;
                    case '1':
                        $gender = '男士';
                        break;
                    case '2':
                        $gender = '中性';
                        break;
                    default:
                        $gender = '';
                }
                $product['gendername'] = $gender;
                // 季节
                $product['ageseasonname'] = Util::getCommasValues(TbAgeseason::class, $product['ageseason'], ['sessionmark', 'name']);

                // 如果有为null，则赋值为空
                foreach (array_keys($product) as $key) {
                    if (is_null($product[$key])) {
                        $product[$key] = '';
                    }
                }
                // 重新赋值
                $return_products[$l] = $product;
            }

            // 赋值
            $datas['items'][$k] = [
                // 公司模型
                'company' => $company->toArray(),
                // 公司用户
                'users' => [
                    'count' => $users->count(),
                    'details' => $return_users,
                ],
                // 公司下属会员
                'members' => [
                    'count' => $members->count(),
                    'details' => $return_members,
                ],
                // 公司下属产品
                'products' => [
                    'count' => $products->count(),
                    'details' => $return_products,
                ],
            ];
            // 累计
            $total_members_count += $members->count();
            $total_users_count += $users->count();
            $total_products_count += $products->count();
        }

        // 添加累计值
        $datas['total'] = [
            'total_members_count' => $total_members_count,
            'total_users_count' => $total_users_count,
            'total_products_count' => $total_products_count,
        ];

        // 渲染模板
        $this->mview->setVars(compact('datas'));
        $this->mview->partial('manager/statis');
    }

}