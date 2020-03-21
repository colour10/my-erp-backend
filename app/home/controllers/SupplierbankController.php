<?php

namespace Multiple\Home\Controllers;

/**
 * 分组表
 * Class SupplierbankController
 * @package Multiple\Home\Controllers
 */
class SupplierbankController extends CadminController
{
    public function initialize()
    {
        parent::initialize();

        $this->setModelName('Asa\\Erp\\TbSupplierBank');
    }

    function before_add()
    {
        $_POST['companyid'] = $this->companyid;
    }

    function before_edit($row)
    {
        if (isset($_POST['companyid']) || isset($_POST['supplierid']) || $row->companyid != $this->companyid) {
            throw new \Exception("/1001/数据非法/");
        }
    }

    function before_delete($row)
    {
        if ($row->companyid != $this->companyid) {
            throw new \Exception('/1002/数据非法/');
        }
    }

    function before_page()
    {
        $_POST['companyid'] = $this->companyid;
    }
}
