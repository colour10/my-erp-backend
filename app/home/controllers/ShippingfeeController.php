<?php

namespace Multiple\Home\Controllers;

use Exception;

/**
 * 费用表
 * Class ShippingfeeController
 * @package Multiple\Home\Controllers
 */
class ShippingfeeController extends CadminController
{
    public function initialize()
    {
        parent::initialize();

        $this->setModelName('Asa\\Erp\\TbShippingFee');
    }

    function before_add()
    {
        $_POST['companyid'] = $this->companyid;
        $_POST['makestaff'] = $this->currentUser;
        $_POST['maketime'] = date("Y-m-d H:i:s");
    }

    function before_edit($row)
    {
        $this->checkExchange($row->shippingid);
    }

    /**
     * 检查是否设置过汇率
     * @param $shippingid
     * @throws Exception
     */
    function checkExchange($shippingid)
    {
        if (!isset($_POST['exchangerate']) || $_POST['exchangerate'] <= 0) {
            throw new Exception("/11150101/汇率不合法。/");
        }
    }
}
