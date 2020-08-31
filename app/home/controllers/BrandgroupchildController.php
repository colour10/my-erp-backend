<?php

namespace Multiple\Home\Controllers;

/**
 * 基础资料，子品类表
 */
class BrandgroupchildController extends ZadminController
{
    /**
     * 初始化
     */
    public function initialize()
    {
        parent::initialize();

        $this->setModelName('Asa\\Erp\\TbBrandgroupchild');
    }

    /**
     * 分页前
     */
    function before_page()
    {
        $_POST["__orderby"] = "displayindex asc";
    }
}
