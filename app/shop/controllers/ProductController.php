<?php
namespace Multiple\Shop\Controllers;

use Asa\Erp\Util;
use Phalcon\Mvc\Controller;
use Phalcon\Mvc\View;
use Asa\Erp\TbProduct;
use Asa\Erp\ZlColortemplate;

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
        // 判断当前域名是否绑定了公司
        if (!$this->host) {
            return $this->dispatcher->forward([
                'controller' => 'error',
                'action' => 'error404',
            ]);
        }
        // 先过滤
        $params = $this->dispatcher->getParams();
        if (!$params || !preg_match('/^[1-9]+\d*$/', $params[0])) {
            exit('Params error!');
        }

        // 赋值
        $id = $params[0];
        // 取出数据
        $product = TbProduct::findFirstById($id);
        // 如果不是当前公司下面的产品，则不允许访问
        if (!$product || $product->company->id != $this->currentCompany) {
            return $this->dispatcher->forward([
                'controller' => 'error',
                'action' => 'error404',
            ]);
        }
        // 尺码组
        if ($product->sizetop) {
            $sizecontents = $product->sizetop->sizecontents->toArray();
        } else {
            $sizecontents = [];
        }
        // 颜色
        if ($product->brandcolor) {
            $colors = explode(',', $product->brandcolor);
            foreach ($colors as $k => $color) {
                $colors_arr[] = ZlColortemplate::findFirstById($color)->toArray();
            }
        } else {
            $colors_arr = [];
        }

        // 取出合同价、成交价格、国内零售价格
        // $orderpricecurrency = Util::change_currency($product->orderpricecurrency);
        $retailpricecurrency = Util::change_currency($product->retailpricecurrency);
        $realprice = round($product->realprice, 2);
        $nationalprice = round($product->nationalprice, 2);
        // $orderprice = $product->orderprice;

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
            'sizecontents' => $sizecontents,
            'colors' => $colors_arr,
            // 'orderpricecurrency' => $orderpricecurrency,
            'retailpricecurrency' => $retailpricecurrency,
            'realprice' => $realprice,
            'nationalprice' => $nationalprice,
            // 'orderprice' => $orderprice,
            'id' => $id,
            'breadcrumb' => $breadcrumb,
        ]);
    }
}
