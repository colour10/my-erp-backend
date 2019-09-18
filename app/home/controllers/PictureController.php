<?php
namespace Multiple\Home\Controllers;

use Phalcon\Mvc\Controller;
use Phalcon\Mvc\View;
use Asa\Erp\TbPicture;
use Asa\Erp\TbProduct;
use Asa\Erp\Util;

/**
 *
 * ErrorCode 1121
 */

class PictureController extends AdminController {
    public function initialize() {
	    parent::initialize();

	    $this->setModelName('Asa\\Erp\\TbPicture');
    }

    function deleteAction() {
        $array = explode(',', $_POST['ids']);
        $product = TbProduct::findFirstById($_POST['productid']);
        if($product!=false && $product->companyid == $this->companyid) {
            $ids = Util::filterIds($_POST['ids']);
            if($ids!="") {
                $pictures = TbPicture::find(
                    sprintf("productid=%d and id in (%s)", $product->id, $ids)
                );

                $this->db->begin();
                foreach($pictures as $row) {
                    //print_r($row->toArray());
                    //echo $row->id;continue;
                    if($row->delete()==false) {
                        $this->db->rollback();
                        throw new \Exception("/1001/操作失败/");
                    }
                }

                $this->db->commit();
                return $this->success();
            }
            else {
                throw new \Exception("/1001/参数错误/");
            }

        }
        else {
            throw new \Exception("/1001/不允许删除/");
        }
    }

    function ofproductsAction() {
        $products = TbProduct::find(
            sprintf("id in (%s)", addslashes($_POST['productids']))
        );

        foreach($products as $product) {
            if($product->companyid != $this->companyid) {
                throw new \Exception('/11210101/没有权限/');
            }
        }

        $pictures = TbPicture::find(
            sprintf("productid in (%s)", addslashes($_POST['productids']))
        );

        return $this->success($pictures->toArray());
    }
}
