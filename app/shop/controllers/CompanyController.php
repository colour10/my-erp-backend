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
        // 开始去数据库查找
        $host = $_SERVER['HTTP_HOST'];
        $company = TbCompany::findFirst("host = '$host'");
        // 判断
        if (!$company) {
            return false;
        } else {
            $name = $this->getlangfield('name');
            return ['company' => $company, 'webtitle' => $company->$name];
        }
    }
}
