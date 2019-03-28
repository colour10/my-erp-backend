<?php
namespace Multiple\Shop\Controllers;

use Phalcon\Mvc\Controller;
use Asa\Erp\ZlBrandgroup;

class BrandgroupController extends AdminController
{

	public function initialize()
    {
        $this->setModelName('Asa\\Erp\\ZlBrandgroup');
    }

    /**
     * 取出主域名
     */
    public function getmainhostAction()
    {
        // 逻辑
        return $this->main_host;
    }

    /**
     * 取出图片域名
     */
    public function getfileprexAction()
    {
        // 逻辑
        return $this->file_prex;
    }

    /**
     * 获取当前品牌的产品列表
     * @param $id
     * @return mixed
     */
    public function detailAction($id)
    {
        // 逻辑
    }
}
