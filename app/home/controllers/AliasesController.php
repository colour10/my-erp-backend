<?php

namespace Multiple\Home\Controllers;

/**
 * 别名表
 * Class AliasesController
 * @package Multiple\Home\Controllers
 */
class AliasesController extends ZadminController
{
    public function initialize()
    {
        parent::initialize();

        $this->setModelName('Asa\\Erp\\TbAliases');
    }
}
