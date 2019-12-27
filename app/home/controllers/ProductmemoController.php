<?php
namespace Multiple\Home\Controllers;

use Phalcon\Mvc\Controller;
use Phalcon\Mvc\View;
use Asa\Erp\TbProductMemo;
use Asa\Erp\TbProductMemoBrandgroupchild;

/**
 * 商品描述
 */
class ProductmemoController extends ZadminController {
    public function initialize() {
	    parent::initialize();

	    $this->setModelName('Asa\\Erp\\TbProductMemo');
    }

    function before_page() {
        if (!empty($this->request->getPost('sort')) && !empty($this->request->getPost('order'))) {
            $orderby = $this->request->getPost('sort');
            switch ($this->request->getPost('order')) {
                case 'ascending':
                    $orderby .= ' asc';
                    break;
                case 'descending':
                    $orderby .= ' desc';
                    break;
                default:
                    $orderby .= ' asc';
                    break;
            }
            $_POST["__orderby"] = $orderby;

        } else {
            $_POST["__orderby"] = "displayindex asc";
        }
    }

    public function saveProductmemoBrandAction()
    {
        $memo_id = $this->request->getPost('productmemo_id');
        $brands = $this->request->getPost('brands');
        $this->deleteProductmemoBrand($memo_id);

        foreach ($brands as $brandgroupchild_id) {
            $model = new TbProductMemoBrandgroupchild;
            $model->memo_id = $memo_id;
            $model->brandgroupchild_id = $brandgroupchild_id;
            $model->save();
        }

        return $this->success();
    }

    public function deleteProductmemoBrand($memo_id)
    {
        $this->modelsManager->registerNamespaceAlias("ERP","Asa\Erp");

        $phql = "DELETE FROM ERP:TbProductMemoBrandgroupchild WHERE memo_id = :memo_id:";

        $this->modelsManager->executeQuery(
            $phql,
            [
                "memo_id" => $memo_id
            ]
        );
    }

    public function getProductmemoBrandgroupchildAction()
    {
        $productmemo_id = $this->request->getPost('productmemo_id');
        $rs = TbProductMemoBrandgroupchild::find("memo_id = $productmemo_id");
        return $this->success($rs);
    }
}
