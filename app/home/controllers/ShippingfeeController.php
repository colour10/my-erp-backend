<?php
namespace Multiple\Home\Controllers;

use Asa\Erp\TbShipping;
use Asa\Erp\TbShippingFee;
use Asa\Erp\TbExchangeRate;

/**
 * 费用表
 * ErrorCode 1115
 */
class ShippingfeeController extends CadminController {
    public function initialize() {
	    parent::initialize();

	    $this->setModelName('Asa\\Erp\\TbShippingFee');
    }

    function before_add() {
        $_POST['companyid'] = $this->companyid;
        $_POST['makestaff'] = $this->currentUser;
        $_POST['maketime'] = date("Y-m-d H:i:s");

        $this->checkExchange();
    }

    function before_edit($row) {
        $this->checkExchange();
    }

    //检查是否设置过汇率
    function checkExchange() {
        $shipping = TbShipping::findFirstById($_POST["shippingid"]);
        if($shipping!=false && $shipping->companyid==$this->companyid) {
            $rate = TbExchangeRate::getExchangeRate($this->companyid, $_POST['currencyid'], $shipping->currency);
        }
        else {
            throw new \Exception("/11150101/数据错误。/");
        }
    }
}
