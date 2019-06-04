<?php

namespace Multiple\Shop\Controllers;

use Asa\Erp\TbBrandgroup;
use Asa\Erp\TbBrandgroupchild;
use Asa\Erp\TbProduct;
use Asa\Erp\TbSizecontent;
use Asa\Erp\TbProductSearch;
use Asa\Erp\TbColortemplate;

/**
 * 产品操作类
 * Class ProductController
 * @package Multiple\Shop\Controllers
 */
class ProductController extends AdminController
{
    /**
     * 初始化
     */
    public function initialize()
    {
        $this->setModelName('Asa\\Erp\\TbProductSearch');
    }

    /**
     * 商品详情页
     */
    public function detailAction()
    {
        // 逻辑
        if (!$this->member) {
            return $this->response->redirect('/login');
        }

        // 先过滤
        $params = $this->dispatcher->getParams();
        if (!$params || !preg_match('/^[1-9]+\d*$/', $params[0])) {
            // 传递错误
            $this->view->setVars([
                'title' => $this->getValidateMessage('make-an-error'),
                'message' => $this->getValidateMessage('params-error'),
            ]);
            return $this->view->pick('error/error');
        }
        // 赋值
        $id = $params[0];
        // 取出数据
        // 如果不存在，就跳转到错误页面
        if (!$product = TbProductSearch::findFirst("productid=$id AND companyid=" . $this->currentCompany)) {
            // 传递错误
            $this->view->setVars([
                'title' => $this->getValidateMessage('make-an-error'),
                'message' => $this->getValidateMessage('product-doesnot-exist'),
            ]);
            return $this->view->pick('error/error');
        }

        // 商品价格
        $realprice = $this->getRealPrice($id);

        // 尺码组颜色需要修改为js调用方式，状态：待修改
        // 尺码组加入多语言字段content
        $name = $this->getlangfield('name');
        $content = $this->getlangfield('content');
        // 尺码组
        if ($product->sizetopid) {
            $sizecontents_arr = TbSizecontent::find("topid=" . $product->sizetopid)->toArray();
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
        $brandgroup = TbBrandgroup::findFirstById($product->brandgroupid);
        $brandgroupchild = TbBrandgroupchild::findFirstById($product->childbrand);
        $name = $this->getlangfield('name');
        $breadcrumb = '<li><a href="/">' . $this->getValidateMessage('shouye') . '</a></li><li><a href="/brandgroup/detail/' . $product->brandgroupid . '">' . $brandgroup->$name . '</a></li><li><a href="/childproductgroup/detail/' . $product->childbrand . '">' . $brandgroupchild->$name . '</a></li>';

        // 推送给模板
        $this->view->setVars([
            'product' => $product,
            'sizecontents' => $sizecontents_arr,
            'colors' => $colors_arr,
            // 'price' => $product->price,
            'realprice' => $realprice,
            'id' => $id,
            'breadcrumb' => $breadcrumb,
            'number' => $product->number,
        ]);
    }


    /**
     * 获取当前productid的价格
     * @param $productid
     * @return string
     */
    public function getRealPrice($productid)
    {
        // 逻辑
        if (!$productModel = TbProduct::findFirstById($productid)) {
            $realprice = '0';
        } else {
            $realprice = $productModel->wordprice;
        }
        // 返回价格
        return $realprice;
    }
}
