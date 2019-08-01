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
use phpDocumentor\Reflection\Types\Self_;

/**
 * 品类操作类
 * Class BrandgroupController
 * @package Multiple\Shop\Controllers
 */
class BrandgroupController extends AdminController
{
    /**
     * 初始化
     */
    public function initialize()
    {
        $this->setModelName('Asa\\Erp\\TbBrandgroup');
    }

    /**
     * 取出主域名
     * @return mixed|void
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
     * @return mixed|void
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
     * @return \Phalcon\Http\Response|\Phalcon\Http\ResponseInterface|\Phalcon\Mvc\View|void
     */
    public function detailAction()
    {
        // 逻辑
        // 判断是否登录
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
        // 名称多语言字段
        $name = $this->getlangfield('name');

        // 在取出库存之前，首先获取销售端口
        $company = TbCompany::findFirstById($member['companyid']);
        // 获取销售端口
        $saleport = $company->shopSaleport;
        $array = $saleport ? Util::recordListColumn($saleport->saleportWarehouses, 'warehouseid') : [];

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
                "group" => 'productid, sizecontentid',
                "column" => 'number',
            ])->toArray() : [];
            // 尺码加入名称，还有最大尺码记录数
            foreach ($sizecontents as $key => $value) {
                $sizecontentname = ($TbSizecontentModel = TbSizecontent::findFirstById($value['sizecontentid'])) ? $TbSizecontentModel->name : '';
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
        // 必须有数据才进行排序
        if ($count) {
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
            // 得出最大尺码组的值，最后需要传递给模板
            $max_sum_sizecontents = '';
        }

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
        $breadcrumb = '<li><a href="/">' . $this->getValidateMessage('shouye') . '</a></li><li class="active">' . $brandGroup->$name . '</li>';

        // 推送给模板
        // 再加上当前object对象
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
    public function frontcatesAction()
    {
        // 逻辑
        $list = TbBrandgroup::find([
            'limit' => '5',
        ]);

        // 语言字段重新设计
        $list_array = $list->toArray();
        foreach ($list_array as $k => $item) {
            $list_array[$k]['name'] = $item[$this->getlangfield('name')];
        }
        // 返回
        return $list_array;
    }

    /**
     * 获取从第6条记录开始的所有记录
     * @return array
     */
    public function leftcatesAction()
    {
        // 逻辑
        // 判断是否超出了6个，如果超过了6个，那么取前5个，最后一个放more
        $list = TbBrandgroup::find();
        $count = count($list);
        $leftlist = [];
        if ($count > 5) {
            // 剩下多少条
            $number = $count - 5;
            // 取出5条之后的记录，单独放置
            $leftlist = TbBrandgroup::find([
                'limit' => ['number' => $number, 'offset' => 6],
            ]);
            // 语言字段重新设计
            $leftlist = $leftlist->toArray();
            foreach ($leftlist as $k => $item) {
                $leftlist[$k]['name'] = $item[$this->getlangfield('name')];
            }
        }

        // 返回
        return $leftlist;
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
    public function getdetailAction(int $id)
    {
        // 逻辑
        $brandGroup = TbBrandgroup::find('id=' . $id);
        // 返回
        return $brandGroup;
    }

}
