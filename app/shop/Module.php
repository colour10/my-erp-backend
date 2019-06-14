<?php

namespace Multiple\Shop;

use Asa\Erp\StaticReader;
use Asa\Erp\TbCompany;
use Asa\Erp\TbCurrency;
use Multiple\Shop\Controllers\AdminController;
use Phalcon\Events\Manager as EventsManager;
use Phalcon\Loader;
use Phalcon\Mvc\View;
use Phalcon\DiInterface;
use Phalcon\Mvc\Dispatcher;
use Phalcon\Mvc\ModuleDefinitionInterface;
use Multiple\Shop\Controllers\BrandgroupController;
use Multiple\Shop\Controllers\BuycarController;
use Multiple\Shop\Controllers\CompanyController;
use Phalcon\Text;
use PHPMailer\PHPMailer\PHPMailer;
use Phalcon\Queue\Beanstalk;

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

                // Create an events manager
                $eventsManager = new EventsManager();

                // 添加一个监听beforeDispatch事件，判断执行的控制器或者动作是否存在，这个动作是最先执行的
                $eventsManager->attach("dispatch:beforeDispatch", function ($event, $dispatcher) {
                    // 获取当前controller的名称
                    $controllerName = $dispatcher->getControllerName();
                    // Controller首字母大写
                    $upperControllerName = Text::camelize($controllerName);
                    // Controller路径补全
                    $controller = "Multiple\\Shop\\Controllers\\" . $upperControllerName . "Controller";
                    // 获取当前action的名称
                    $actionName = $dispatcher->getActionName();
                    // action名称补全
                    $action = $actionName . "Action";

                    // 判断这个controller中是否含有这个action
                    // 如果controller不存在，或者action不存在，那么就直接跳转到首页
                    if (!get_class_methods($controller) || !in_array($action, get_class_methods($controller))) {
                        header("location:/");
                        exit;
                    }
                });

                $dispatcher->setDefaultNamespace("Multiple\\Shop\\Controllers");

                // Assign the events manager to the dispatcher
                $dispatcher->setEventsManager($eventsManager);

                // 返回
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
        $session = $di->get('session');
        $di->setShared('main_host', function () use ($config) {
            return $config['app']['main_host'];
        });

        // 配置文件
        $di->setShared('config', function () use ($config) {
            return $config->toArray();
        });

        // 商城域名
        $di->setShared('shop_host', function () use ($config) {
            return $config['app']['shop_host'];
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
        $di->setShared('frontcates', function () use ($brandGroup) {
            $cates = $brandGroup->frontcatesAction();
            return $cates;
        });

        // 取出从第6条开始剩下的主分类
        $di->setShared('leftcates', function () use ($brandGroup) {
            $cates = $brandGroup->leftcatesAction();
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

        // 获取当前域名及所属公司的模型
        $tbcompany = new CompanyController();
        $di->setShared('host', function () use ($tbcompany) {
            $host = $tbcompany->gethost();
            return $host;
        });

        // 获取所有公司列表
        $di->setShared('allcompany', function () {
            $datas = TbCompany::find()->toArray();
            return $datas;
        });

        // 为了使用共享model数据，需要注册currentCompany
        $di->setShared('currentCompany', function () use ($session) {
            if ($session->has("member")) {
                $member = $session->get("member");
                return $member["companyid"];
            } else {
                return "";
            }
        });

        // 默认货币，以后会从配置文件导入，这个先随便写个，有变动在修改
        $di->setShared('currency', function () {
            return "$";
        });

        // 默认联系邮箱
        $di->setShared('contactEmail', function () {
            return "806316776@qq.com";
        });

        // 登录用户信息
        $di->setShared('member', function () use ($di, $session) {
            if ($session->has("member")) {
                $member = $session->get("member");
                return $member;
            } else {
                return [];
            }
        });

        // 访问静态列表数据的资源
        $di->setShared('staticReader', function () use ($di) {
            $reader = new StaticReader();
            $reader->setDI($di);
            return $reader;
        });

        // 主控制器模型
        $di->setShared('obj', function () {
            return new AdminController();
        });

        // 判断是否为管理员
        $di->setShared('isadmin', function () use ($tbcompany) {
            return $tbcompany->isadmin();
        });

        // 取出虚拟公司
        $di->setShared('supercoid', function () use ($tbcompany) {
            return $tbcompany->getSuperCoId();
        });

        // phpmainer
        $di->setShared('phpmailer', function () {
            return new PHPMailer();
        });

        // 队列，但是依赖于系统服务beanstalk是否开启
        $di->setShared('queue', function () {
            // 屏蔽错误，防止Beanstalk服务没有启动引起报错
            ini_set('display_errors', 'off');
            error_reporting(0);
            // 连接到队列
            $beanstalk = new Beanstalk(
                [
                    "host" => "localhost",
                    "port" => "11300",
                ]
            );
            try {
                if ($beanstalk->connect()) {
                    return $beanstalk;
                }
            } catch (\Exception $e) {
                // 如果没有连接，返回否
                return false;
            }
        });

        // 取出欧元
        $di->setShared('eur', function () {
            $currency = TbCurrency::findFirst("name_cn='欧元'");
            if ($currency) {
                return $currency->id;
            } else {
                return 0;
            }
        });

    }
}