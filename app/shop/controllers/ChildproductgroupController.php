<?php

namespace Multiple\Shop\Controllers;

use Asa\Erp\TbBrandgroup;
use Asa\Erp\TbProductSearch;
use Asa\Erp\TbBrandgroupchild;
use Phalcon\Paginator\Adapter\Model as PaginatorModel;

/**
 * 基础资料，子品类表
 */
class ChildproductgroupController extends AdminController {

    public function initialize() {
        $this->setModelName('Asa\\Erp\\TbBrandgroupchild');
    }


    /**
     * 获取当前子分类产品列表
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

        // 取出子品类
        $childbrand = TbBrandgroupchild::findFirstById($id);
        // 如果模型不存在，则返回404
        if (!$childbrand) {
            return $this->dispatcher->forward([
                'controller' => 'error',
                'action' => 'error404',
            ]);
        }

        // 分页
        $currentPage = $this->request->getQuery("page", "int", 1);
        // 取出数据，只展示当前公司下面的产品
        // 从tb_product_search中查询
        $products = TbProductSearch::find("childbrand=$id AND companyid={$this->currentCompany}");
        // 必要的多语言字段
        $name = $this->getlangfield('name');
        // 判断是否有记录，如果有记录，就随便取一条记录，从中得到子品类和主品类相关信息
        if (count($products)) {
            // 取第一条记录
            // 主品类
            $brandgroupid = $products[0]->brandgroupid;
            $brandgroup = TbBrandgroup::findFirstById($brandgroupid);
        } else {
            // 取出主品类
            $brandgroup = $childbrand->brandgroup;
            // 主品类相关字段
            $brandgroupid = $brandgroup->id;
        }

        // 主品类相关字段
        $brandgroupname = $brandgroup->$name;

        // 子品类相关字段
        $childbrandname = $childbrand->$name;

        // 创建分页对象
        $paginator = new PaginatorModel(
            [
                "data"  => $products,
                "limit" => 10,
                "page"  => $currentPage,
            ]
        );

        // 展示分页
        $page = $paginator->getPaginate();

        // 定义面包屑导航
        $breadcrumb = '<li><a href="/">首页</a></li><li><a href="/brandgroup/detail/'.$brandgroupid.'">'.$brandgroupname.'</a></li><li class="active">'.$childbrandname.'</li>';

        // 推送给模板
        $this->view->setVars([
            'page' => $page,
            'id' => $id,
            'breadcrumb' => $breadcrumb,
            'title' => $childbrandname,
        ]);
    }
}
