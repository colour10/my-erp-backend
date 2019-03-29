<?php
namespace Multiple\Shop\Controllers;

use Phalcon\Mvc\Controller;
use Phalcon\Mvc\View;
use Asa\Erp\TbProduct;

class ProductController extends AdminController {
    public function initialize() {
        $this->setModelName('Asa\\Erp\\TbProduct');
    }

    /**
     * 商品详情页
     */
    public function detailAction()
    {
        // 逻辑
        // 先过滤
        $params = $this->dispatcher->getParams();
        if (!$params || !preg_match('/^[1-9]+\d*$/', $params[0])) {
            exit('Params error!');
        }

        // 赋值
        $id = $params[0];
        // 取出数据
        $product = TbProduct::findFirstById($id);

        // 取出上级分类
        $childproductgroup = $product->childproductgroup;
        $brandgroup = $childproductgroup->brandgroup;

        // 定义面包屑导航
        $lang = $this->getDI()->get('language')->lang;
        $name = 'name_'.$lang;
        $breadcrumb = '<li><a href="/">首页</a></li><li><a href="/brandgroup/detail/'.$brandgroup->id.'">'.$brandgroup->$name.'</a></li><li><a href="/childproductgroup/detail/'.$childproductgroup->id.'">'.$childproductgroup->$name.'</a></li>';

        // 推送给模板
        $this->view->setVars([
            'product' => $product,
            'id' => $id,
            'breadcrumb' => $breadcrumb,
        ]);
    }
}
