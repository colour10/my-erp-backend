<?php

namespace Multiple\Shop\Controllers;

use Asa\Erp\TbBrandgroup;
use Asa\Erp\TbCompany;
use Asa\Erp\TbProduct;
use Asa\Erp\TbProductSearch;
use Asa\Erp\TbBrandgroupchild;
use Asa\Erp\TbProductstock;
use Asa\Erp\TbSizecontent;
use Asa\Erp\Util;
use Phalcon\Paginator\Adapter\NativeArray as PaginatorArray;

/**
 * 基础资料，子品类表
 */
class ChildproductgroupController extends AdminController
{

    public function initialize()
    {
        $this->setModelName('Asa\\Erp\\TbBrandgroupchild');
    }


    /**
     * 获取当前子分类产品列表
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

        // 取出子品类
        $childbrand = TbBrandgroupchild::findFirstById($id);
        // 如果模型不存在，则返回404
        if (!$childbrand) {
            return $this->dispatcher->forward([
                'controller' => 'error',
                'action' => 'error404',
            ]);
        }
        // 子品类名称
        // 多语言字段
        // 名称
        $name = $this->getlangfield('name');
        // 尺码
        $contentname = $this->getlangfield('content');
        $childbrandname = $childbrand->$name;

        // 主品类名称
        $brandgroup = $childbrand->brandgroup;
        if ($brandgroup) {
            $brandgroupname = $brandgroup->$name;
            $brandgroupid = $brandgroup->id;
        }

        // 分页
        $currentPage = $this->request->getQuery("page", "int", 1);
        // 取出数据，只展示当前公司下面的产品
        // 从tb_product_search中查询
        $productsModel = TbProductSearch::find("childbrand=$id AND companyid={$this->currentCompany}");


        // 加工数据
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
        if ($count > 0) {
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
        } else {
            $max_sum_sizecontents = 0;
        }

        // 创建分页对象
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
        $breadcrumb = '<li><a href="/">首页</a></li><li><a href="/brandgroup/detail/' . $brandgroupid . '">' . $brandgroupname . '</a></li><li class="active">' . $childbrandname . '</li>';

        // 推送给模板
        $this->view->setVars([
            'page' => $page,
            'id' => $id,
            'breadcrumb' => $breadcrumb,
            'title' => $childbrandname,
            'max_sum_sizecontents' => $max_sum_sizecontents,
        ]);
    }
}
