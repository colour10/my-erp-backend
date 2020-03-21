<?php

namespace Multiple\Home\Controllers;

/**
 * 各个公司私有数据的表的基类
 * Class CadminController
 * @package Multiple\Home\Controllers
 */
class CadminController extends AdminController
{
    public function initialize()
    {
        parent::initialize();
    }

    function before_add()
    {
        $this->injectParam("companyid", $this->companyid);
    }

    function before_edit($row)
    {
        if ($row->companyid != $this->companyid) {
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
        $this->injectParam("companyid", $this->companyid);
    }
}
