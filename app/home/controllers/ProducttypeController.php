<?php

namespace Multiple\Home\Controllers;

/**
 * 商品属性表
 * Class ProducttypeController
 * @package Multiple\Home\Controllers
 */
class ProducttypeController extends ZadminController
{
    public function initialize()
    {
        parent::initialize();

        $this->setModelName('Asa\\Erp\\TbProductType');
    }
}
