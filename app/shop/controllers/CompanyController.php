<?php

namespace Multiple\Shop\Controllers;

use Phalcon\Mvc\Controller;
use Phalcon\Mvc\View;
use Asa\Erp\TbCompany;

/**
 * 公司域名表
 */
class CompanyController extends AdminController {
    public function initialize() {
	    $this->setModelName('Asa\\Erp\\TbCompany');
    }

    /**
     * 检查域名是否进行了绑定，并取出公司名称，作为网站主标题名称
     */
    public function gethost()
    {
        // 判断之前必须登录，否则域名很有可能不受程序的控制
        $login_result = $this->islogin;
        if (!$login_result) {
            // 未登录返回假
            return false;
        } else {
            // 如果已经登录了就去数据库查找
            $companyid = $login_result['companyid'];
            $company = TbCompany::findFirstById($companyid);
            // 如果需要判断域名是否已经绑定的话，需要先看看company模型当中的host字段是否为空，如果为空，则默认用主shop域名访问；否则就用里面写好的域名，但是还要在index.php动态添加新的跳转规则，可能会破坏之前的完整性，待商榷...
            // 然后返回结果
            $name = $this->getlangfield('name');
            return ['company' => $company, 'webtitle' => $company->$name];
        }
    }
}
