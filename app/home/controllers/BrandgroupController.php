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
     * 获取主品牌列表，跨域使用
     * @return string
     */
    public function getlistAction()
    {
        // 逻辑
        $callback = $this->request->get('callback');
        $list = ZlBrandgroup::find();
        // 此处的callback需要和客户端ajax请求中的jsonp属性保持一致。
        return $callback."(".json_encode($list).")";
    }


    /**
     * 获取当前品类的相关信息
     * @param $id
     * @return string
     */
    public function getdetailAction($id)
    {
        // 逻辑
        $callback = $this->request->get('callback');
        $brandGroup = ZlBrandgroup::find('id='.$id);
        // 此处的callback需要和客户端ajax请求中的jsonp属性保持一致。
        return $callback."(".json_encode($brandGroup).")";
    }
}
