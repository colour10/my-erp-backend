<?php

namespace Multiple\Shop\Controllers;

use Asa\Erp\TbProductSearch;
use Phalcon\Paginator\Adapter\NativeArray as PaginatorArray;

/**
 * 首页控制器类
 * Class IndexController
 * @package Multiple\Shop\Controllers
 */
class IndexController extends AdminController
{
    /**
     * 首页
     * @return \Phalcon\Http\Response|\Phalcon\Http\ResponseInterface|void
     */
    public function indexAction()
    {
        // 逻辑
        // 验证是否登录
        if (!$member = $this->member) {
            return $this->response->redirect('/login');
        }

        // 最新促销，需要从当前域名绑定的公司提取资料，默认取出12个
        if (!$productlist = TbProductSearch::find("companyid={$this->currentCompany} limit 12")) {
            $productlist = [];
        }

        // 还缺少价格，现在进行补充，暂时用product表中的国际零售价代替（需要修改）
        $productlist_array = $productlist->toArray();
        foreach ($productlist as $k => $product) {
            $productlist_array[$k]['realprice'] = $product->product->wordprice;
            // 商品名称
            $productlist_array[$k]['productname'] = $product->getProductname();
        }

        // 分配到模板
        $this->view->setVars([
            'productlist' => $productlist_array,
        ]);

    }

    /**
     * 搜索
     * @return \Phalcon\Http\Response|\Phalcon\Http\ResponseInterface|void
     */
    public function searchAction()
    {
        // 逻辑
        // 验证是否登录
        if (!$member = $this->member) {
            return $this->response->redirect('/login');
        }

        // 外部搜索内容
        $keyword = $this->request->get('keyword', 'string', '');
        // 分页
        $currentPage = $this->request->getQuery("page", "int", 1);

        // 取出结果
        $productlist = TbProductSearch::find([
            'conditions' => 'productname like :keyword: AND companyid = ' . $this->currentCompany,
            'bind' => ['keyword' => '%' . $keyword . '%'],
        ]);

        // 还缺少价格，现在进行补充，暂时用product表中的国际零售价代替（需要修改）
        $productlist_array = $productlist->toArray();
        foreach ($productlist as $k => $product) {
            $productlist_array[$k]['realprice'] = $product->product->wordprice;
            // 商品名称
            $productlist_array[$k]['productname'] = $product->getProductname();
        }

        // 创建分页对象
        $paginator = new PaginatorArray(
            [
                "data" => $productlist_array,
                "limit" => 1,
                "page" => $currentPage,
            ]
        );

        // 展示分页
        $page = $paginator->getPaginate();

        // 分配到模板
        $this->view->setVars([
            'page' => $page,
            'keyword' => $keyword,
        ]);
    }
}
