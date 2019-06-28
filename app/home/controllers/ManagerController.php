<?php
namespace Multiple\Home\Controllers;

use Phalcon\Mvc\Controller;
use Phalcon\Mvc\View;
use Asa\Erp\TbCompany;

/**
 * 公司表
 */
class CompanyController extends AdminController {
    public function initialize() {
	    parent::initialize();

	    $this->setModelName('Asa\\Erp\\TbCompany');
    }

    function infoAction() {
        $company = TbCompany::findFirstById($this->currentCompany);
        if($company!=false) {
            return $this->success($company->toArray());
        }
        else {
            throw new \Exception("/1002/公司数据不存在/");            
        }
    }

    function updateAction() {
        $company = TbCompany::findFirstById($this->currentCompany);
        if($company!=false) {
            $array = ['id', 'uniqid'];

            $fields = $this->getAttributes();
            foreach ($fields as $name) {
                if (isset($_POST[$name]) && !in_array($name,$array)) {
                    $company->$name = $_POST[$name];
                }
            }
            if($company->update()==false) {
                return $this->error($company);
            }
            return $this->success();
        }
        else {
            throw new \Exception("/1002/公司数据不存在/");            
        }
    }
}
