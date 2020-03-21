<?php

namespace Multiple\Home\Controllers;

/**
 * 包装代码表, 但是目前数据库暂时没有这张表
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
