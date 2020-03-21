<?php

namespace Multiple\Home\Controllers;

/**
 * 付款方式表
 * Class PaymentwayController
 * @package Multiple\Home\Controllers
 */
class PaymentwayController extends CadminController
{
    public function initialize()
    {
        parent::initialize();

        $this->setModelName('Asa\\Erp\\TbPaymentway');
    }
}
