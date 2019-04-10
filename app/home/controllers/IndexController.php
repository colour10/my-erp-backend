<?php
namespace Multiple\Home\Controllers;
use Phalcon\Mvc\Controller;
use Asa\Erp\TbDepartment;
use Asa\Erp\TbUser;
use Asa\Erp\TbCompany;
use Asa\Erp\TbRequisitionDetail;
use Phalcon\Mvc\View;

class IndexController extends BaseController
{

	public function indexAction()
	{
        $this->view->enable();
        $this->view->setVar("system_language", $this->language);
        $this->view->setVar("__sytem_time", time());
        
        $default_language = $this->config->language;
        $this->view->setVar("__default_language", $this->config->language);
        $this->view->setVar("__config", $this->config);
	}    
}
