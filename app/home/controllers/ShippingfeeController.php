<?php
namespace Multiple\Home\Controllers;

use Phalcon\Mvc\Controller;
use Phalcon\Mvc\View;
use Asa\Erp\TbShippingFee;

/**
 * 费用表
 */
class ShippingfeeController extends CadminController {
    public function initialize() {
	    parent::initialize();

	    $this->setModelName('Asa\\Erp\\TbShippingFee');
    }

    function before_add() {
        $_POST['makestaff'] = $this->currentUser;
        $_POST['maketime'] = date("Y-m-d H:i:s");
    }
}
