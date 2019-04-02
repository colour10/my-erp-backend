<?php
namespace Multiple\Shop\Controllers;

use Asa\Erp\Util;
use Asa\Erp\ZlSizecontent;
use Phalcon\Mvc\Controller;
use Phalcon\Mvc\View;
use Asa\Erp\TbProductSearch;
use Asa\Erp\ZlColortemplate;

class ProductController extends AdminController {
    public function initialize() {
        $this->setModelName('Asa\\Erp\\TbProductSearch');
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
        $product = TbProductSearch::findFirst("productid=$id");

        // 如果不是当前公司下面的产品，则不允许访问
        if (!$product || $product->companyid != $this->currentCompany) {
            return $this->dispatcher->forward([
                'controller' => 'error',
                'action' => 'error404',
            ]);
        }
        // 尺码组
        if ($product->sizetopid) {
            $sizecontents = ZlSizecontent::find("topid=".$product->sizetopid)->toArray();
        } else {
            $sizecontents = [];
        }
        // 颜色
        if ($product->color) {
            $colors = explode(',', $product->color);
            foreach ($colors as $k => $color) {
                $colors_arr[] = ZlColortemplate::findFirstById($color)->toArray();
            }
        } else {
            $colors_arr = [];
        }

        // 取出零售价格、批发价格
        $orderpricecurrency = Util::change_currency($product->orderpricecurrency);
        $orderprice = $product->orderprice;
        $retailpricecurrency = Util::change_currency($product->retailpricecurrency);
        $realprice = round($product->realprice, 2);

        // 定义面包屑导航
        $brandgroupname = $this->getlangfield('brandgroupname');
        $childbrandname = $this->getlangfield('childbrandname');
        $breadcrumb = '<li><a href="/">首页</a></li><li><a href="/brandgroup/detail/'.$product->brandgroupid.'">'.$product->$brandgroupname.'</a></li><li><a href="/childproductgroup/detail/'.$product->childbrand.'">'.$product->$childbrandname.'</a></li>';

        // 库存显示文字
        if ($product->number) {
            $number_desc = $product->number;
        } else {
            $number_desc = '缺货';
        }

        // 推送给模板
        $this->view->setVars([
            'product' => $product,
            'sizecontents' => $sizecontents,
            'colors' => $colors_arr,
            'retailpricecurrency' => $retailpricecurrency,
            'realprice' => $realprice,
            'orderpricecurrency' => $orderpricecurrency,
            'orderprice' => $orderprice,
            'id' => $id,
            'breadcrumb' => $breadcrumb,
            'number' => $number_desc,
        ]);
    }
}
