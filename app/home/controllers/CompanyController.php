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
    /**
     * 初始化
     */
    public function initialize()
    {
        parent::initialize();

        $this->setModelName('Asa\\Erp\\TbCompany');
    }

    /**
     * 查看公司信息
     *
     * @return false|string
     * @throws Exception
     */
    function infoAction()
    {
        $company = TbCompany::findFirstById($this->currentCompany);
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
        $company = TbCompany::findFirstById($this->currentCompany);
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
}
