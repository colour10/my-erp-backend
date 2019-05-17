<?php

namespace Multiple\Shop\Controllers;

use Asa\Erp\TbCompany;
use Asa\Erp\TbProduct;
use Asa\Erp\TbProductSearch;
use Asa\Erp\TbBrandgroup;
use Asa\Erp\TbProductstock;
use Asa\Erp\TbSizecontent;
use Asa\Erp\Util;
use Phalcon\Paginator\Adapter\NativeArray as PaginatorArray;

/**
 * 品类操作类
 * Class BrandgroupController
 * @package Multiple\Shop\Controllers
 */
class BrandgroupController extends AdminController
{

    public function initialize()
    {
        $this->setModelName('Asa\\Erp\\TbBrandgroup');
    }

    /**
     * 取出主域名
     */
    public function getmainhostAction()
    {
        // 逻辑
        if ($this->request->isPost()) {
            return $this->main_host;
        }
    }

    /**
     * 取出图片域名
     */
    public function getfileprexAction()
    {
        // 逻辑
        if ($this->request->isPost()) {
            return $this->file_prex;
        }
    }

    /**
     * 获取当前主分类产品列表
     */
    public function detailAction()
    {
        // 逻辑
        // 判断是否登录
        if (!$member = $this->session->get('member')) {
            return $this->dispatcher->forward([
                'controller' => 'login',
                'action' => 'index',
            ]);
        }

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
        $brandGroup = TbBrandgroup::findFirstById($id);
        // 定义一个变量用来存储结果
        $brandGroup_ids = [];
        // 寻找下面的子品类id
        foreach ($brandGroup->brandgroupchilds as $childgroup) {
            $brandGroup_ids[] = $childgroup->id;
        }

        // 再加上自己
        array_unshift($brandGroup_ids, $id);

        // 查找隶属于子品类的商品
        $productsModel = TbProductSearch::find([
            'conditions' => 'childbrand IN ({brandGroup_ids:array}) AND companyid = ' . $this->currentCompany,
            'bind' => ['brandGroup_ids' => $brandGroup_ids],
        ]);

        // 加工数据
        // 尺码多语言字段
        $contentname = $this->getlangfield('content');
        // 在取出库存之前，首先获取销售端口
        $company = TbCompany::findFirstById($member['companyid']);
        $saleport = $company->shopSaleport;
        $array = Util::recordListColumn($saleport->saleportWarehouses, 'warehouseid');
        if (count($array) == 0) {
            return $array;
        }

        // 需要拿到每个商品下面所有的尺码，库存数
        $products = $productsModel->toArray();
        foreach ($productsModel as $k => $item) {
            // 国际码
            $productModel = TbProduct::findFirstById($item->productid);
            if ($productModel) {
                $wordcode = $productModel->wordcode_1 . $productModel->wordcode_2 . $productModel->wordcode_3 . $productModel->wordcode_4;
            } else {
                $wordcode = '';
            }
            if ($item->sizetopid) {
                $sizecontents = TbProductstock::sum([
                    sprintf("warehouseid in (%s) and defective_level=0 and productid = %s", implode(',', $array), $item->productid),
                    "group" => 'productid, sizecontentid',
                    "column" => 'number',
                ]);
                if ($sizecontents) {
                    $sizecontents = $sizecontents->toArray();
                }
            } else {
                $sizecontents = [];
            }
            // 尺码组赋值
            $products[$k]['sizecontents'] = $sizecontents;
            // 国际码赋值
            $products[$k]['wordcode'] = $wordcode;
        }

        // 重新遍历，把尺码名称填写进去
        // 每个分页当中把当前最大尺码记录数加入进去
        foreach ($products as $k => $product) {
            // 把sizecontents的统计数量加入进去
            $products[$k]['sum_sizecontents'] = count($product['sizecontents']);
            foreach ($product['sizecontents'] as $key => $item) {
                $TbSizecontentModel = TbSizecontent::findFirstById($item['sizecontentid']);
                if ($TbSizecontentModel) {
                    $sizecontentname = $TbSizecontentModel->$contentname;
                } else {
                    $sizecontentname = '';
                }
                $products[$k]['sizecontents'][$key]['sizecontentname'] = $sizecontentname;
            }
        }

        // 使用冒泡排序算法得出当前最大sum_sizecontents值
        $count = count($products);
        for ($i = 0; $i < $count - 1; $i++) {
            for ($j = 0; $j < $count - $i - 1; $j++) {
                if ($products[$j]['sum_sizecontents'] > $products[$j + 1]['sum_sizecontents']) {
                    $temp = $products[$j];
                    $products[$j] = $products[$j + 1];
                    $products[$j + 1] = $temp;
                }
            }
        }

        // 得出最大尺码组的值，最后需要传递给模板
        $max_sum_sizecontents = $products[$count - 1]['sum_sizecontents'];

        // 创建分页对象，使用数组分页
        $paginator = new PaginatorArray(
            [
                "data" => $products,
                "limit" => 10,
                "page" => $currentPage,
            ]
        );

        // 展示分页
        $page = $paginator->getPaginate();

        // 定义面包屑导航
        $name = $this->getlangfield('name');
        $breadcrumb = '<li><a href="/">首页</a></li><li class="active">' . $brandGroup->$name . '</li>';

        // 推送给模板
        $this->view->setVars([
            'page' => $page,
            'id' => $id,
            'breadcrumb' => $breadcrumb,
            'title' => $brandGroup->$name,
            'max_sum_sizecontents' => $max_sum_sizecontents,
        ]);
    }


    /**
     * 获取前5个主品牌列表
     * @return array
     */
    public function catesAction()
    {
        // 逻辑
        // 判断是否超出了6个，如果超过了6个，那么取前5个，最后一个放more
        $list = TbBrandgroup::find();
        if (count($list) > 6) {
            $list = TbBrandgroup::find([
                'limit' => '5',
            ]);
        }

        // 语言字段重新设计
        $list_array = $list->toArray();
        foreach ($list_array as $k => $item) {
            $list_array[$k]['name'] = $item[$this->getlangfield('name')];
        }
        // 返回
        return $list_array;
    }

    /**
     * 获取所有的主品牌列表
     * @return array
     */
    public function allfirstcatesAction()
    {
        // 逻辑
        // 判断是否超出了6个，如果超过了6个，那么取前5个，最后一个放more
        $list = TbBrandgroup::find();

        // 语言字段重新设计
        $list_array = $list->toArray();
        foreach ($list_array as $k => $item) {
            $list_array[$k]['name'] = $item[$this->getlangfield('name')];
        }
        // 返回
        return $list_array;
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
        $list = TbBrandgroup::find();
        if ($list) {
            $list_arr = $list->toArray();
        }
        // 填充子分类
        foreach ($list_arr as $k => $item) {
            $list_arr[$k]['name'] = $item[$this->getlangfield('name')];
            // 开始添加子分类当前语言信息
            $childproductgroups_array = TbBrandgroup::findFirstById($item['id'])->brandgroupchilds->toArray();
            // 判断是否有子分类
            if ($childproductgroups_array) {
                foreach ($childproductgroups_array as $key => $childproductgroup) {
                    $childproductgroups_array[$key]['name'] = $childproductgroup[$this->getlangfield('name')];
                }
            }
            // 添加子分类
            $list_arr[$k]['children'] = $childproductgroups_array;
        }
        // 返回
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
        $brandGroup = TbBrandgroup::find('id=' . $id);
        // 返回
        return $brandGroup;
    }

}
