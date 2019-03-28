<?php
namespace Multiple\Shop\Controllers;

use Phalcon\Mvc\Controller;
use Phalcon\Mvc\View;
use Asa\Erp\ZlChildproductgroup;

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
    }
}
