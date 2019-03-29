<?php

namespace Multiple\Shop\Controllers;

use Asa\Erp\TbProduct;
use Phalcon\Paginator\Adapter\Model as PaginatorModel;

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
     * 搜索
     */
    public function searchAction()
    {
        // 逻辑
        // 外部搜索内容
        $keyword = $this->request->get('keyword', 'string', '');
        // 分页
        $currentPage = $this->request->getQuery("page", "int", 1);

        // 取出结果
        $productlist = TbProduct::find([
            'conditions' => 'productname like :keyword:',
            'bind' => ['keyword' => '%'.$keyword.'%'],
        ]);

        // 创建分页对象
        $paginator = new PaginatorModel(
            [
                "data"  => $productlist,
                "limit" => 10,
                "page"  => $currentPage,
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
