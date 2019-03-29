<?php
namespace Multiple\Shop\Controllers;

use Phalcon\Mvc\Controller;
use Asa\Erp\ZlBrandgroup;
use Asa\Erp\TbProduct;
use Phalcon\Paginator\Adapter\Model as PaginatorModel;

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
     * 获取当前主分类产品列表
     */
    public function detailAction()
    {
        // 逻辑
        // 先过滤
        $params = $this->dispatcher->getParams();
        if (!$params || !preg_match('/^[1-9]+\d*$/', $params[0])) {
            exit('Params error!');
        }

        // 赋值
        $id = $params[0];
        // 分页
        $currentPage = $this->request->getQuery("page", "int", 1);
        // 取出数据
        $brandGroup = ZlBrandgroup::findFirstById($id);
        // 定义一个变量用来存储结果
        $brandGroup_ids = [];
        // 寻找下面的子品类id
        foreach ($brandGroup->childproductgroups as $childgroup) {
            $brandGroup_ids[] = $childgroup->id;
        }

        // 再加上自己
        array_unshift($brandGroup_ids, $id);

        // 查找隶属于子品类的商品
        $products = TbProduct::find([
            'conditions'=>'childbrand IN ({brandGroup_ids:array})',
            'bind'=>['brandGroup_ids'=>$brandGroup_ids]
        ]);

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

        // 定义面包屑导航
        $lang = $this->getDI()->get('language')->lang;
        $name = 'name_'.$lang;
        $breadcrumb = '<li><a href="/">首页</a></li><li class="active">'.$brandGroup->$name.'</li>';

        // 推送给模板
        $this->view->setVars([
            'page' => $page,
            'id' => $id,
            'breadcrumb' => $breadcrumb,
        ]);
    }


    /**
     * 获取主品牌列表
     * @return array
     */
    public function catesAction()
    {
        // 逻辑
        $list = ZlBrandgroup::find();
        // 此处的callback需要和客户端ajax请求中的jsonp属性保持一致
        return $list->toArray();
    }


    /**
     * 获取主品牌以及下面所有的子品类
     * @return array
     */
    public function allcatesAction()
    {
        // 逻辑
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
        return $list_arr;
    }


    /**
     * 获取当前品类的相关信息
     * @param $id
     * @return string
     */
    public function getdetailAction($id)
    {
        // 逻辑
        $brandGroup = ZlBrandgroup::find('id='.$id);
        // 返回
        return $brandGroup;
    }


}
