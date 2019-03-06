<?php
namespace Multiple\Home\Controllers;

use Phalcon\Mvc\Controller;
use Phalcon\Mvc\View;
use Asa\Erp\TbMemberPreferenceSize;

/**
 * 会员相关，会员偏好尺码表
 */
class MemberpreferencesizeController extends AdminController {
    public function initialize() {
	    parent::initialize();

	    $this->setModelName('Asa\\Erp\\TbMemberPreferenceSize');
    }
}
