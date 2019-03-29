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
     * @param $id
     * @return mixed
     */
    public function detailAction($id)
    {
        // 逻辑
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

        // 推送给模板
        $this->view->setVars([
            'page' => $page,
            'id' => $id,
            'file_prex' => $this->file_prex,
        ]);
    }
}
