<?php
namespace Multiple\Home\Controllers;

use Phalcon\Mvc\Controller;
use Phalcon\Mvc\View;
use Asa\Erp\TbMemberContactor;

/**
 * 会员相关，会员公司联系人表
 */
class MembercontactorController extends AdminController {
    public function initialize() {
	    parent::initialize();

	    $this->setModelName('Asa\\Erp\\TbMemberContactor');
    }
}
