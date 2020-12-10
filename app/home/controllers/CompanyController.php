<?php

namespace Multiple\Home\Controllers;

use Asa\Erp\TbCompany;
use Exception;

/**
 * 公司表
 * Class CompanyController
 * @package Multiple\Home\Controllers
 */
class CompanyController extends AdminController
{
    // 当前公司
    protected $company;

    /**
     * 初始化
     */
    public function initialize()
    {
        parent::initialize();

        $this->setModelName('Asa\\Erp\\TbCompany');

        // 当前公司的节点
        $this->company = TbCompany::findFirstById($this->currentCompany);
    }

    /**
     * 查看公司信息
     *
     * @return false|string
     * @throws Exception
     */
    function infoAction()
    {
        $company = $this->company;
        if ($company != false) {
            return $this->success($company->toArray());
        } else {
            throw new Exception("/1002/公司数据不存在/");
        }
    }

    /**
     * 更新公司信息
     *
     * @return false|string
     * @throws Exception
     */
    function updateAction()
    {
        $company = $this->company;
        if ($company != false) {
            $array = ['id', 'uniqid'];

            $fields = $this->getAttributes();
            foreach ($fields as $name) {
                if (isset($_POST[$name]) && !in_array($name, $array)) {
                    $company->$name = $_POST[$name];
                }
            }
            if ($company->update() == false) {
                return $this->error($company);
            }
            return $this->success();
        } else {
            throw new Exception("/1002/公司数据不存在/");
        }
    }

    /**
     * 获取登录用户所属公司的所有用户列表
     *
     * @return false|string
     */
    public function usersAction()
    {
        return $this->success($this->company->users);
    }

    /**
     * 获取登录用户所属公司的所有仓库列表
     *
     * @return false|string
     */
    public function warehousesAction()
    {
        // 逻辑
        return $this->success($this->company->warehouses);
    }

    /**
     * 获取登录用户所属公司的销售端口列表
     *
     * @return false|string
     */
    public function saleportsAction()
    {
        return $this->success($this->company->saleports);
    }

    /**
     * 获取登录用户所属公司的所有客户列表
     *
     * @return false|string
     */
    public function customersAction()
    {
        // 逻辑
        $return = [];
        $suppliers = $this->company->suppliers->toArray();
        foreach ($suppliers as $supplier) {
            if ($supplier['suppliertype'] == 2) {
                $return[] = $supplier;
            }
        }
        // 返回
        return $this->success($return);
    }

    /**
     * 获取登录用户所属公司的所有供货商列表
     *
     * @return false|string
     */
    public function suppliersAction()
    {
        // 逻辑
        $return = [];
        $suppliers = $this->company->suppliers->toArray();
        foreach ($suppliers as $supplier) {
            if ($supplier['suppliertype'] == 4) {
                $return[] = $supplier;
            }
        }
        // 返回
        return $this->success($return);
    }

    /**
     * 获取登录用户所属公司的所有会员列表
     *
     * @return false|string
     */
    public function membersAction()
    {
        // 逻辑
        return $this->success($this->company->members);
    }
}
