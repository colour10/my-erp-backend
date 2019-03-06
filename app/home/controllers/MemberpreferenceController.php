<?php
namespace Multiple\Home\Controllers;

use Phalcon\Mvc\Controller;
use Phalcon\Mvc\View;
use Asa\Erp\TbMemberPreference;

/**
 * 会员相关，会员偏好表
 */
class MemberpreferenceController extends AdminController {
    public function initialize() {
	    parent::initialize();

	    $this->setModelName('Asa\\Erp\\TbMemberPreference');
    }
}
