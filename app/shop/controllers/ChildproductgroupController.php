<?php

namespace Multiple\Shop\Controllers;

use Asa\Erp\TbBrandgroupchild;
use Asa\Erp\TbCompany;
use Asa\Erp\TbProduct;
use Asa\Erp\TbProductSearch;
use Asa\Erp\TbProductstock;
use Asa\Erp\TbSizecontent;
use Asa\Erp\Util;
use Phalcon\Paginator\Adapter\NativeArray as PaginatorArray;

/**
 * 基础资料，子品类表
 * Class ChildproductgroupController
 * @package Multiple\Shop\Controllers
 */
class ChildproductgroupController extends AdminController
{
    /**
     * 初始化
     */
    public function initialize()
    {
        $this->setModelName('Asa\\Erp\\TbBrandgroupchild');
    }


    /**
     * 获取当前子分类产品列表
     * @return \Phalcon\Http\Response|\Phalcon\Http\ResponseInterface|\Phalcon\Mvc\View|void
     */
    public function detailAction()
    {
        // 逻辑
        // 验证是否登录
        if (!$member = $this->member) {
            return $this->response->redirect('/login');
        }

        // 先过滤
        $params = $this->dispatcher->getParams();
        if (!$params || !preg_match('/^[1-9]+\d*$/', $params[0])) {
            // 传递错误
            return $this->renderError();
        }

        // 赋值
        $id = $params[0];

        // 取出子品类
        $childbrand = TbBrandgroupchild::findFirstById($id);
        // 如果模型不存在，则给出错误提示
        if (!$childbrand) {
            // 传递错误
            return $this->renderError('make-an-error', 'brandgroupchild-doesnot-exist');
        }
        // 子品类名称
        // 多语言字段
        // 名称
        $name           = $this->getlangfield('name');
        $childbrandname = $childbrand->$name;

        // 主品类名称
        $brandgroup = $childbrand->brandgroup;
        if ($brandgroup) {
            $brandgroupname = $brandgroup->$name;
            $brandgroupid   = $brandgroup->id;
        }

        // 分页
        $currentPage = $this->request->getQuery("page", "int", 1);
        // 取出数据，只展示当前公司下面的产品
        // 从tb_product_search中查询
        $productsModel = TbProductSearch::find([
            "childbrand = :childbrand: AND companyid = :companyid:",
            'bind' => [
                'childbrand' => $id,
                'companyid'  => $this->currentCompany,
            ],
        ]);


        // 加工数据
        // 在取出库存之前，首先获取销售端口
        $company  = TbCompany::findFirstById($member['companyid']);
        $saleport = $company->shopSaleport;
        $array    = $saleport ? Util::recordListColumn($saleport->saleportWarehouses, 'warehouseid') : [];


        // 需要拿到每个商品下面所有的尺码，库存数
        $products = $productsModel->toArray();
        foreach ($productsModel as $k => $item) {
            // 产品模型判断
            $productModel = TbProduct::findFirstById($item->productid);
            // 国际码
            $products[$k]['wordcode'] = $productModel->wordcode ?: '';
            // 实际价格
            $products[$k]['realprice'] = $productModel->wordprice ?: 0;
            // 尺码
            $sizecontents = ($item->sizetopid && $array) ? TbProductstock::sum([
                sprintf("warehouseid in (%s) and defective_level=0 and productid = %s", implode(',', $array), $item->productid),
                "group"  => 'productid, sizecontentid',
                "column" => 'number',
            ])->toArray() : [];
            // 尺码加入名称，还有最大尺码记录数
            foreach ($sizecontents as $key => $value) {
                $sizecontentname                       = ($TbSizecontentModel = TbSizecontent::findFirstById($value['sizecontentid'])) ? $TbSizecontentModel->name : '';
                $sizecontents[$key]['sizecontentname'] = $sizecontentname;
            }
            // 尺码组赋值
            $products[$k]['sizecontents'] = $sizecontents;
            // 商品名称
            $products[$k]['productname'] = $item->getProductname();
            // 尺码组统计数量
            $products[$k]['sum_sizecontents'] = count($sizecontents);
        }


        // 使用冒泡排序算法得出当前最大sum_sizecontents值
        $count = count($products);
        if ($count > 0) {
            for ($i = 0; $i < $count - 1; $i++) {
                for ($j = 0; $j < $count - $i - 1; $j++) {
                    if ($products[$j]['sum_sizecontents'] > $products[$j + 1]['sum_sizecontents']) {
                        $temp             = $products[$j];
                        $products[$j]     = $products[$j + 1];
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
                "data"  => $products,
                "limit" => 10,
                "page"  => $currentPage,
            ]
        );

        // 展示分页
        $page = $paginator->getPaginate();

        // 定义面包屑导航
        $breadcrumb = '<li><a href="/">' . $this->getValidateMessage('shouye') . '</a></li><li><a href="/brandgroup/detail/' . $brandgroupid . '">' . $brandgroupname . '</a></li><li class="active">' . $childbrandname . '</li>';

        // 推送给模板
        $this->view->setVars([
            'page'                 => $page,
            'id'                   => $id,
            'breadcrumb'           => $breadcrumb,
            'title'                => $childbrandname,
            'max_sum_sizecontents' => $max_sum_sizecontents,
        ]);
    }
}
