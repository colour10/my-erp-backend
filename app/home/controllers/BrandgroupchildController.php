<?php

namespace Multiple\Home\Controllers;

/**
 * 基础资料，子品类表
 */
class BrandgroupchildController extends ZadminController
{
    public function initialize()
    {
        parent::initialize();

        $this->setModelName('Asa\\Erp\\TbBrandgroupchild');
    }

    function before_page()
    {
        $_POST["__orderby"] = "displayindex asc";
    }
}
