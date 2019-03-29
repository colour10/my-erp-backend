<?php

namespace Multiple\Shop\Controllers;

use Asa\Erp\TbProduct;

class IndexController extends AdminController
{

    /**
     * 首页
     */
    public function indexAction()
    {
        // 逻辑
        // 最新促销
        $productlist = TbProduct::find();
        // 分配到模板
        $this->view->setVars([
           'productlist' => $productlist,
        ]);
    }

    /**
     * 测试，如果需要引用其他命名空间的模块，只能用dispatcher来做跳转
     */
    public function testAction()
    {
        $this->dispatcher->forward([
            'module' => 'home',
            'controller' => 'index',
            'action' => 'index'
        ]);
    }
}
