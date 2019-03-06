<?php
namespace Multiple\Home\Controllers;

use Phalcon\Mvc\Controller;
use Phalcon\Mvc\View;
use Asa\Erp\TbMemberCardHistory;

/**
 * 会员相关，储值卡操作记录表
 */
class MembercardhistoryController extends AdminController {
    public function initialize() {
	    parent::initialize();

	    $this->setModelName('Asa\\Erp\\TbMemberCardHistory');
    }
}
