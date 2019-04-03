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

        // 判断是否登录
        if (!$this->session->get('member')) {
            return $this->dispatcher->forward([
                'controller' => 'login',
                'action' => 'index',
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
        $product = TbProductSearch::findFirst("productid=$id AND companyid=".$this->currentCompany);

        // 如果不存在，就跳转到404
        if (!$product) {
            return $this->dispatcher->forward([
                'controller' => 'error',
                'action' => 'error404',
            ]);
        }
        // 尺码组颜色需要修改为js调用方式，状态：待修改
        $name = $this->getlangfield('name');
        $content = $this->getlangfield('content');
        // 尺码组
        if ($product->sizetopid) {
            $sizecontents_arr = ZlSizecontent::find("topid=".$product->sizetopid)->toArray();
            foreach ($sizecontents_arr as $k => $sizecontent) {
                $sizecontents_arr[$k]['content'] = $sizecontent[$content];
            }
        } else {
            $sizecontents_arr = [];
        }
        // 颜色
        if ($product->color) {
            $colors = explode(',', $product->color);
            foreach ($colors as $k => $color) {
                $colors_arr[] = ZlColortemplate::findFirstById($color)->toArray();
            }
            foreach ($colors_arr as $k => $item) {
                $colors_arr[$k]['name'] = $item[$name];
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

        // 推送给模板
        $this->view->setVars([
            'product' => $product,
            'sizecontents' => $sizecontents_arr,
            'colors' => $colors_arr,
            'retailpricecurrency' => $retailpricecurrency,
            'realprice' => $realprice,
            'orderpricecurrency' => $orderpricecurrency,
            'orderprice' => $orderprice,
            'id' => $id,
            'breadcrumb' => $breadcrumb,
            'number' => $product->number,
        ]);
    }
}
