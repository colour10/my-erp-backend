<?php
namespace Multiple\Home\Controllers;

use Phalcon\Mvc\Controller;
use Asa\Erp\ZlBrandgroup;

class BrandgroupController extends ZadminController
{

	public function initialize()
    {
        parent::initialize();
        $this->setModelName('Asa\\Erp\\ZlBrandgroup');
        
        // $this->setTitle("品类维护");
    }

    /**
     * 获取主品牌列表
     */
    public function getlistAction()
    {
        // 逻辑
        $list = ZlBrandgroup::find('sys_delete_flag=0');
        return $this->success($list);
    }
}
