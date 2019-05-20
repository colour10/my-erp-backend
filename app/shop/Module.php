<?php

namespace Multiple\Shop;

use Multiple\Shop\Controllers\IndexController;
use Phalcon\Loader;
use Phalcon\Mvc\View;
use Phalcon\DiInterface;
use Phalcon\Mvc\Dispatcher;
use Phalcon\Mvc\ModuleDefinitionInterface;
use Multiple\Shop\Controllers\BrandgroupController;
use Multiple\Shop\Controllers\BuycarController;
use Multiple\Shop\Controllers\CompanyController;

class Module implements ModuleDefinitionInterface
{
    /**
     * 注册自定义加载器
     */
    public function registerAutoloaders(DiInterface $di = null)
    {
        $loader = new Loader();

        $loader->registerNamespaces(
            [
                "Multiple\\Shop\\Controllers" => "../app/shop/controllers/",
            ]
        );

        $loader->register();
    }

    /**
     * 注册自定义服务
     */
    public function registerServices(DiInterface $di)
    {
        // Registering a dispatcher
        $di->set(
            "dispatcher",
            function () {
                $dispatcher = new Dispatcher();

                $dispatcher->setDefaultNamespace("Multiple\\Shop\\Controllers");

                return $dispatcher;
            }
        );

        // Registering the view component
        $di->set(
            "view",
            function () {
                $view = new View();
                // 定义视图层目录
                $view->setViewsDir('../app/shop/views/');
                return $view;
            }
        );

        // 主域名
        $config = $di->get("config");
        $di->setShared('main_host', function () use ($config) {
            $main_host = $config['app']['main_host'];
            return $main_host;
        });

        // 图片域名
        $di->setShared('file_prex', function () use ($config) {
            $file_prex = $config['file_prex'];
            return $file_prex;
        });

        // 为了使用共享model数据，需要注册language
        $di->setShared('language', function () use ($config, $di) {
            $language = $config->language;
            return new \Phalcon\Config\Adapter\Php(APP_PATH . "/app/config/languages/{$language}.php");
        });

        // 取出前5个主分类
        $brandGroup = new BrandgroupController();
        $di->setShared('cates', function () use ($brandGroup) {
            $cates = $brandGroup->catesAction();
            return $cates;
        });

        // 取出所有的主分类
        $di->setShared('allfirstcates', function () use ($brandGroup) {
            $cates = $brandGroup->allfirstcatesAction();
            return $cates;
        });

        // 取出所有的主分类以及二级分类
        $di->setShared('allcates', function () use ($brandGroup) {
            $allcates = $brandGroup->allcatesAction();
            return $allcates;
        });

        // 获取购物车
        $buycar = new BuycarController();
        $di->setShared('buycar', function () use ($buycar) {
            $cates = $buycar->getListsAction();
            return $cates;
        });

        // 判断是否登录
        $di->setShared('islogin', function () {
            $index = new IndexController();
            return $index->isloginAction();
        });

        // 获取当前域名及所属公司的模型
        $tbcompany = new CompanyController();
        $di->setShared('host', function () use ($tbcompany) {
            $host = $tbcompany->gethost();
            return $host;
        });

        // 为了使用共享model数据，需要注册currentCompany
        $di->setShared('currentCompany', function () use ($tbcompany) {
            $result = $tbcompany->gethost();
            if ($result) {
                return $result['company']->id;
            }
        });

        // 默认货币，以后会从配置文件导入，这个先随便写个，有变动在修改
        $di->setShared('currency', function () {
            return "$";
        });
    }
}