<?php

namespace Multiple\Shop\Controllers;

use Asa\Erp\TbCompany;
use Asa\Erp\TbMember;
use Phalcon\Http\Response;
use Phalcon\Http\ResponseInterface;

/**
 * 公司操作类
 * Class CompanyController
 * @package Multiple\Shop\Controllers
 */
class CompanyController extends AdminController
{
    public function initialize()
    {
        $this->setModelName('Asa\\Erp\\TbCompany');
    }

    /**
     * 检查域名是否进行了绑定，并取出公司名称，作为网站主标题名称
     */
    public function gethost()
    {
        // 判断之前必须登录，否则域名很有可能不受程序的控制
        $login_result = $this->member;
        if (!$login_result) {
            // 未登录返回假
            return false;
        } else {
            // 如果已经登录了就去数据库查找
            $companyid = $login_result['companyid'];
            $company = TbCompany::findFirstById($companyid);
            // 如果需要判断域名是否已经绑定的话，需要先看看company模型当中的host字段是否为空，如果为空，则默认用主shop域名访问；否则就用里面写好的域名，但是还要在index.php动态添加新的跳转规则，可能会破坏之前的完整性，待商榷...
            // 然后返回结果
            return ['company' => $company, 'webtitle' => $company->name];
        }
    }

    /**
     * 是否超级管理员用户
     * @return false|Response|ResponseInterface|string
     */
    public function issuperadmin()
    {
        // 逻辑
        if (!$companyid = $this->getSuperCoId()) {
            return false;
        }

        // 顺便创建一个虚拟公司的用户
        if (!$memberModel = TbMember::findFirst("login_name='VirtualCorporation'")) {
            if (!$this->db->execute("INSERT INTO tb_member(`name`,`login_name`, `password`, `companyid`, `membertype`) VALUES('VirtualCorporation', 'VirtualCorporation', md5('VirtualCorporation'), $companyid, '1')")) {
                return false;
            }
        }

        // 判断该用户是否是超级公司的用户
        if ($this->currentCompany != $companyid) {
            return false;
        }

        // 否则返回真
        return true;
    }

    /**
     * 是否管理员用户
     * @return false|Response|ResponseInterface|string
     */
    public function isadmin()
    {
        // 逻辑
        // 如果当前用户是公司会员，那么就是管理员；如果是个人会员，就是普通用户
        if ($this->member && $this->member['membertype']) {
            return true;
        }
        return false;
    }

    /**
     * 取出虚拟公司的id
     * @return bool|\Phalcon\Mvc\Model\Resultset|\Phalcon\Mvc\Phalcon\Mvc\Model
     */
    public function getSuperCoId()
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

        // 赋值
        return $companyModel->id;
    }

}
