<?php
namespace Multiple\Home\Controllers;

use Asa\Erp\TbProduct;
use Asa\Erp\ZlChildproductgroup;
use Phalcon\Mvc\Controller;
use Asa\Erp\ZlBrandgroup;
use Asa\Erp\Util;

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
        // 此处的callback需要和客户端ajax请求中的jsonp属性保持一致
        return $callback."(".json_encode($list).")";
    }

    /**
     * 获取主品牌以及下面所有的子品类，跨域使用
     * @return string
     */
    public function getalllistAction()
    {
        // 逻辑
        $callback = $this->request->get('callback');
        // 定义一个变量用来存储结果
        $list_arr = [];
        // 取出所有一级品牌
        $list = ZlBrandgroup::find();
        if($list) {
            $list_arr = $list->toArray();
        }
        // 填充子分类
        foreach ($list_arr as $k => $item) {
            $list_arr[$k]['children'] = ZlBrandgroup::findFirstById($item['id'])->childproductgroups->toArray();
        }
        // 此处的callback需要和客户端ajax请求中的jsonp属性保持一致
        return $callback."(".json_encode($list_arr).")";
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
        // 此处的callback需要和客户端ajax请求中的jsonp属性保持一致
        return $callback."(".json_encode($brandGroup).")";
    }

    /**
     * 获取当前主品类下面的所有商品
     * @return string
     */
    public function detailAction($id)
    {
        // 逻辑
        $callback = $this->request->get('callback');
        $brandGroup = ZlBrandgroup::findFirstById($id);
        // 定义一个变量用来存储结果
        $brandGroup_ids = [];
        // 寻找下面的子品类id
        foreach ($brandGroup->childproductgroups as $childgroup) {
            $brandGroup_ids[] = $childgroup->id;
        }
        // 查找隶属于子品类的商品
        $products = TbProduct::find([
            'conditions'=>'childbrand IN ({brandGroup_ids:array})',
            'bind'=>['brandGroup_ids'=>$brandGroup_ids]
        ]);
        // 返回
        // 此处的callback需要和客户端ajax请求中的jsonp属性保持一致
        return $callback."(".json_encode($products).")";
    }
}
