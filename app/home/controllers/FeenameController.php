<?php

namespace Multiple\Home\Controllers;

/**
 * 费用名称表
 * Class FeenameController
 * @package Multiple\Home\Controllers
 */
class FeenameController extends ZadminController
{
    public function initialize()
    {
        parent::initialize();

        $this->setModelName('Asa\\Erp\\TbFeename');
    }
}
