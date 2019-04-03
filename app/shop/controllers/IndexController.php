<?php

namespace Multiple\Shop\Controllers;

use Asa\Erp\TbProductSearch;
use Asa\Erp\Util;
use Phalcon\Paginator\Adapter\Model as PaginatorModel;

class IndexController extends AdminController
{
    /**
     * 首页
     */
    public function indexAction()
    {
        // 逻辑
        // 判断当前域名是否绑定了公司
        if (!$this->host) {
            return $this->dispatcher->forward([
                'controller' => 'error',
                'action' => 'error404',
            ]);
        }

        // 判断是否登录
        if (!$this->session->get('member')) {
            return $this->dispatcher->forward([
                'controller' => 'login',
                'action' => 'index',
            ]);
        }

        // 最新促销，需要从当前域名绑定的公司提取资料
        $productlist = TbProductSearch::find("companyid={$this->currentCompany}")->toArray();
        // 把币种加工一下
        foreach ($productlist as $k => $item) {
            $productlist[$k]['retailpricecurrency2'] = Util::change_currency($item['retailpricecurrency']);
        }
        // 分配到模板
        $this->view->setVars([
            'productlist' => $productlist,
        ]);
    }

    /**
     * 搜索
     */
    public function searchAction()
    {
        // 逻辑
        // 判断当前域名是否绑定了公司
        if (!$this->host) {
            return $this->dispatcher->forward([
                'controller' => 'error',
                'action' => 'error404',
            ]);
        }

        // 判断是否登录
        if (!$this->session->get('member')) {
            return $this->dispatcher->forward([
                'controller' => 'login',
                'action' => 'index',
            ]);
        }

        // 外部搜索内容
        $keyword = $this->request->get('keyword', 'string', '');
        // 分页
        $currentPage = $this->request->getQuery("page", "int", 1);

        // 取出结果
        $productlist = TbProductSearch::find([
            'conditions' => 'productname like :keyword:',
            'bind' => ['keyword' => '%'.$keyword.'%'],
        ]);

        // 创建分页对象
        $paginator = new PaginatorModel(
            [
                "data"  => $productlist,
                "limit" => 10,
                "page"  => $currentPage,
            ]
        );

        // 展示分页
        $page = $paginator->getPaginate();

        // 分配到模板
        $this->view->setVars([
            'page' => $page,
            'keyword' => $keyword,
        ]);
    }

    /**
     * 判断是否登录，并拿到当前用户模型
     * @return false|string
     */
    public function isloginAction()
    {

        // 判断是否登录
        if (!$this->session->get('member')) {
            return $this->dispatcher->forward([
                'controller' => 'login',
                'action' => 'index',
            ]);
        }
    }

    /*
     * 测试页面
     */
    public function testAction()
    {

    }

    // /**
    //  * 判断公司是否绑定了当前域名，接口，js当中用的
    //  */
    // public function checkhostAction()
    // {
    //     // 逻辑
    //     $params = $this->dispatcher->getParams();
    //     if (!$params) {
    //         exit('params error');
    //     }
    //     // 赋值
    //     $host = $params[0];
    //     // 开始去数据库查找
    //     $result = TbCompanyhost::findFirst("url = '$host'");
    //     // 返回
    //     if ($result) {
    //         return json_encode($result);
    //     } else {
    //         return false;
    //     }
    // }
}
