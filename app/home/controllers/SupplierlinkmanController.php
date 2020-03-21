<?php

namespace Multiple\Home\Controllers;

/**
 * 供应商，联系人信息
 * Class SupplierlinkmanController
 * @package Multiple\Home\Controllers
 */
class SupplierlinkmanController extends AdminController
{
    public function initialize()
    {
        parent::initialize();

        $this->setModelName('Asa\\Erp\\TbSupplierLinkman');
    }
}
