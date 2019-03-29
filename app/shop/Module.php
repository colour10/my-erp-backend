<?php

namespace Multiple\Shop;

use Phalcon\Loader;
use Phalcon\Mvc\View;
use Phalcon\DiInterface;
use Phalcon\Mvc\Dispatcher;
use Phalcon\Mvc\ModuleDefinitionInterface;
use Multiple\Shop\Controllers\BrandgroupController;

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
                "Multiple\\Shop\\Controllers" => "../app/shop/controllers/"
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

        // 取出所有的主分类
        $brandGroup = new BrandgroupController();
        $di->setShared('cates', function () use ($brandGroup) {
            $cates = $brandGroup->catesAction();
            return $cates;
        });

        // 取出所有的主分类以及二级分类
        $di->setShared('allcates', function () use ($brandGroup) {
            $allcates = $brandGroup->allcatesAction();
            return $allcates;
        });

    }
}