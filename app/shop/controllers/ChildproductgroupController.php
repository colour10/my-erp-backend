<?php
namespace Multiple\Shop\Controllers;

use Phalcon\Mvc\Controller;
use Phalcon\Mvc\View;
use Asa\Erp\ZlChildproductgroup;
use Phalcon\Paginator\Adapter\Model as PaginatorModel;

/**
 * 基础资料，子品类表
 */
class ChildproductgroupController extends AdminController {

    public function initialize() {
	    $this->setModelName('Asa\\Erp\\ZlChildproductgroup');
    }


    /**
     * 获取当前子分类产品列表
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
        // 分页
        $currentPage = $this->request->getQuery("page", "int", 1);
        // 取出数据
        $model = ZlChildproductgroup::findFirstById($id);
        $products= $model->products;

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

        // 取出上级
        $brandgroup = $model->brandgroup;

        // 定义面包屑导航
        $lang = $this->getDI()->get('language')->lang;
        $name = 'name_'.$lang;
        $breadcrumb = '<li><a href="/">首页</a></li><li><a href="/brandgroup/detail/'.$brandgroup->id.'">'.$brandgroup->$name.'</a></li><li class="active">'.$model->$name.'</li>';

        // 推送给模板
        $this->view->setVars([
            'page' => $page,
            'id' => $id,
            'breadcrumb' => $breadcrumb,
        ]);
    }
}
