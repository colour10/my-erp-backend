<?php
namespace Multiple\Home\Controllers;

use Phalcon\Mvc\Controller;
use Phalcon\Mvc\View;
use Asa\Erp\ZlChildproductgroup;

/**
 * 基础资料，子品类表
 */
class ChildproductgroupController extends ZadminController {
    public function initialize() {
	    parent::initialize();

	    $this->setModelName('Asa\\Erp\\ZlChildproductgroup');
    }

    /**
     * 获取当前品类下面的所有商品
     * @param $id
     * @return string
     */
    public function detailAction($id)
    {
        // 逻辑
        $callback = $this->request->get('callback');
        $model = ZlChildproductgroup::findFirstById($id);
        $products= $model->products;
        // 此处的callback需要和客户端ajax请求中的jsonp属性保持一致
        return $callback."(".json_encode($products).")";
    }
}
