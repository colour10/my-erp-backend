<?php

namespace Multiple\Shop\Controllers;

use Asa\Erp\TbSizecontent;
use Asa\Erp\TbProductSearch;
use Asa\Erp\TbColortemplate;

/**
 * 产品操作类
 * Class ProductController
 * @package Multiple\Shop\Controllers
 */
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
        // 尺码组加入多语言字段content
        $name = $this->getlangfield('name');
        $content = $this->getlangfield('content');
        // 尺码组
        if ($product->sizetopid) {
            $sizecontents_arr = TbSizecontent::find("topid=".$product->sizetopid)->toArray();
            foreach ($sizecontents_arr as $k => $sizecontent) {
                $sizecontents_arr[$k]['content'] = $sizecontent[$content];
            }
        } else {
            $sizecontents_arr = [];
        }
        // 颜色，添加多语言字段name
        if ($product->color) {
            $colors = explode(',', $product->color);
            foreach ($colors as $k => $color) {
                $colors_arr[] = TbColortemplate::findFirstById($color)->toArray();
            }
            foreach ($colors_arr as $k => $item) {
                $colors_arr[$k]['name'] = $item[$name];
            }
        } else {
            $colors_arr = [];
        }

        // 定义面包屑导航
        $brandgroupname = $this->getlangfield('brandgroupname');
        $childbrandname = $this->getlangfield('childbrandname');
        $breadcrumb = '<li><a href="/">首页</a></li><li><a href="/brandgroup/detail/'.$product->brandgroupid.'">'.$product->$brandgroupname.'</a></li><li><a href="/childproductgroup/detail/'.$product->childbrand.'">'.$product->$childbrandname.'</a></li>';

        // 推送给模板
        $this->view->setVars([
            'product' => $product,
            'sizecontents' => $sizecontents_arr,
            'colors' => $colors_arr,
            'price' => $product->price,
            'realprice' => $product->realprice,
            'id' => $id,
            'breadcrumb' => $breadcrumb,
            'number' => $product->number,
        ]);
    }
}
