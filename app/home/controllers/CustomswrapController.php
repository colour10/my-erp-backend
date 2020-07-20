<?php

namespace Multiple\Home\Controllers;

/**
 * 海关包装代码表
 *
 * Class CustomswrapController
 * @package Multiple\Home\Controllers
 */
class CustomswrapController extends AdminController
{
    public function initialize()
    {
        parent::initialize();

        $this->setModelName('Asa\\Erp\\TbCustomsWrap');
    }
}
