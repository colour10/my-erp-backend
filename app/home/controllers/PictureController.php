<?php

namespace Multiple\Home\Controllers;

use Asa\Erp\TbPicture;
use Asa\Erp\TbProduct;
use Asa\Erp\Util;
use Exception;

/**
 * 图片表控制器
 * Class PictureController
 * @package Multiple\Home\Controllers
 */
class PictureController extends AdminController
{
    /**
     * 初始化
     */
    public function initialize()
    {
        parent::initialize();

        $this->setModelName('Asa\\Erp\\TbPicture');
    }

    /**
     * 图片删除
     *
     * @return false|string
     * @throws Exception
     */
    function deleteAction()
    {
        $array = explode(',', $_POST['ids']);
        $product = TbProduct::findFirstById($_POST['productid']);
        if ($product != false && $product->companyid == $this->companyid) {
            $ids = Util::filterIds($_POST['ids']);
            if ($ids != "") {
                $pictures = TbPicture::find(
                    sprintf("productid=%d and id in (%s)", $product->id, $ids)
                );

                $this->db->begin();
                foreach ($pictures as $row) {
                    if ($row->delete() == false) {
                        $this->db->rollback();
                        throw new Exception("/1001/操作失败/");
                    }
                }

                $this->db->commit();
                return $this->success();
            } else {
                throw new Exception("/1001/参数错误/");
            }

        } else {
            throw new Exception("/1001/不允许删除/");
        }
    }

    /**
     * @return false|string
     * @throws Exception
     */
    function ofproductsAction()
    {
        $products = TbProduct::find(
            sprintf("id in (%s)", addslashes($_POST['productids']))
        );

        foreach ($products as $product) {
            if ($product->companyid != $this->companyid) {
                throw new Exception('/11210101/没有权限/');
            }
        }

        $pictures = TbPicture::find(
            sprintf("productid in (%s)", addslashes($_POST['productids']))
        );

        return $this->success($pictures->toArray());
    }

    /**
     * 新增前的钩子
     */
    function before_add()
    {
        // 逻辑
        $fileName = dirname($this->pictureDir) . '/' . $_POST['filename'];
        // 上传图片，我们需要生成40*40和150*150分辨率的缩略图
        $_POST['filename_40'] = Util::resizeImage($fileName, 40, 40);
        $_POST['filename_150'] = Util::resizeImage($fileName, 150, 150);
    }
}
