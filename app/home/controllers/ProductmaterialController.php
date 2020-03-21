<?php

namespace Multiple\Home\Controllers;

/**
 * 商品材质表
 * Class ProductmaterialController
 * @package Multiple\Home\Controllers
 */
class ProductmaterialController extends AdminController
{
    public function initialize()
    {
        parent::initialize();

        $this->setModelName('Asa\\Erp\\TbProductMaterial');
    }
}
