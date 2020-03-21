<?php

namespace Multiple\Home\Controllers;

/**
 * 货币表
 * Class CurrencyController
 * @package Multiple\Home\Controllers
 */
class CurrencyController extends ZadminController
{
    public function initialize()
    {
        parent::initialize();

        $this->setModelName('Asa\\Erp\\TbCurrency');
    }
}
