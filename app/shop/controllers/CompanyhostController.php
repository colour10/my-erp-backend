<?php
namespace Multiple\Shop\Controllers;

use Phalcon\Mvc\Controller;
use Phalcon\Mvc\View;
use Asa\Erp\TbCompanyhost;

/**
 * 公司域名表
 */
class CompanyhostController extends AdminController {
    public function initialize() {
	    $this->setModelName('Asa\\Erp\\TbCompanyhost');
    }

    /**
     * 检查域名是否进行了绑定，并取出公司名称，作为网站主标题名称
     */
    public function gethost()
    {
        // 开始去数据库查找
        $host = $_SERVER['HTTP_HOST'];
        $companyhost = TbCompanyhost::findFirst("url = '$host'");
        // 判断
        if (!$companyhost) {
            return false;
        } else {
            $company = $companyhost->company;
            $name = $this->getlangfield('name');
            return ['companyhost' => $companyhost, 'company' => $company, 'webtitle' => $company->$name];
        }
    }
}
