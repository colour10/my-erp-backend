<?php

namespace Multiple\Shop;

use Asa\Erp\StaticReader;
use Asa\Erp\TbBrand;
use Asa\Erp\TbBrandgroup;
use Asa\Erp\TbCompany;
use Asa\Erp\TbCurrency;
use Asa\Erp\TbProductSearch;
use Asa\Erp\TbShoppayment;
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
use Yansongda\Pay\Pay;

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
        // 常用的一些参数
        $config = $di->get("config");
        $config_array = $config->toArray();
        $session = $di->get('session');
        $language = $session->get('language') ?: $config->language;
        $admin = new AdminController();

        // Registering a dispatcher
        $di->set(
            "dispatcher",
            function () use ($config) {
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


                // 如果是非开发模式，存在异常就用友好提示抛出
                $eventsManager->attach("dispatch:beforeException", function ($event, $dispatcher, $exception) use ($config) {
                    //非开发模式,拦截异常并处理
                    if ($config->mode != 'develop') {
                        switch ($exception->getCode()) {
                            //控制器或动作不存在的时候
                            case Dispatcher::EXCEPTION_HANDLER_NOT_FOUND:
                            case Dispatcher::EXCEPTION_ACTION_NOT_FOUND:
                                $dispatcher->forward(
                                    [
                                        'controller' => 'error',
                                        'action' => 'show404',
                                    ]
                                );
                                break;
                            default:
                                $dispatcher->forward(
                                    [
                                        'controller' => 'error',
                                        'action' => 'show500',
                                    ]
                                );

                        }
                        return false;
                    }
                });

                // 设置默认命名空间
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
        $di->setShared('language', function () use ($language) {
            return new \Phalcon\Config\Adapter\Php(APP_PATH . "/app/config/languages/{$language}.php");
        });

        // language转换成数组
        $di->setShared('languageArr', function () use ($language) {
            $language = new \Phalcon\Config\Adapter\Php(APP_PATH . "/app/config/languages/{$language}.php");
            return $language->toArray();
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
        $di->setShared('obj', function () use ($admin) {
            return $admin;
        });

        // 判断是否为管理员，这个是总管理员
        $di->setShared('issuperadmin', function () use ($tbcompany) {
            return $tbcompany->issuperadmin();
        });

        // 取出虚拟公司id
        $di->setShared('supercoid', function () use ($tbcompany) {
            return $tbcompany->getSuperCoId();
        });

        // 判断是否为公司用户，也就是每个公司下面的管理员
        $di->setShared('isadmin', function () use ($tbcompany) {
            return $tbcompany->isadmin();
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

        // 取出女性品牌
        $di->setShared('girlbrands', function () use ($admin) {
            $name = $admin->getlangfield('name');
            $products = TbProductSearch::find([
                'conditions' => 'gender = 0',
                'columns' => "brandid",
            ]);
            // 品牌id列表
            $brandids = array_unique(array_column($products->toArray(), 'brandid'));
            // 把品牌名称进行整合
            $return = [];
            foreach ($brandids as $k => $id) {
                $return[] = [
                    'id' => $id,
                    'name' => TbBrand::findFirst("id=" . $id)->$name,
                ];
            }
            return $return;
        });

        // 取出女性品类
        $di->setShared('girlbrandgroups', function () use ($admin) {
            $name = $admin->getlangfield('name');
            $products = TbProductSearch::find([
                'conditions' => 'gender = 0',
                'columns' => "brandgroupid",
            ]);
            // 品类id列表
            $brandgroupids = array_unique(array_column($products->toArray(), 'brandgroupid'));
            // 把品牌名称进行整合
            $return = [];
            foreach ($brandgroupids as $k => $id) {
                $return[] = [
                    'id' => $id,
                    'name' => TbBrandgroup::findFirst("id=" . $id)->$name,
                ];
            }
            return $return;
        });

        // 取出男性品牌
        $di->setShared('boybrands', function () use ($admin) {
            $name = $admin->getlangfield('name');
            $products = TbProductSearch::find([
                'conditions' => 'gender = 1',
                'columns' => "brandid",
            ]);
            // 品牌id列表
            $brandids = array_unique(array_column($products->toArray(), 'brandid'));
            // 把品牌名称进行整合
            $return = [];
            foreach ($brandids as $k => $id) {
                $return[] = [
                    'id' => $id,
                    'name' => TbBrand::findFirst("id=" . $id)->$name,
                ];
            }
            return $return;
        });

        // 取出男性品类
        $di->setShared('boybrandgroups', function () use ($admin) {
            $name = $admin->getlangfield('name');
            $products = TbProductSearch::find([
                'conditions' => 'gender = 1',
                'columns' => "brandgroupid",
            ]);
            // 品类id列表
            $brandgroupids = array_unique(array_column($products->toArray(), 'brandgroupid'));
            // 把品牌名称进行整合
            $return = [];
            foreach ($brandgroupids as $k => $id) {
                $return[] = [
                    'id' => $id,
                    'name' => TbBrandgroup::findFirst("id=" . $id)->$name,
                ];
            }
            return $return;
        });

        // 取出儿童品牌，也就是中性
        $di->setShared('childbrands', function () use ($admin) {
            $name = $admin->getlangfield('name');
            $products = TbProductSearch::find([
                'conditions' => 'gender = 2',
                'columns' => "brandid",
            ]);
            // 品牌id列表
            $brandids = array_unique(array_column($products->toArray(), 'brandid'));
            // 把品牌名称进行整合
            $return = [];
            foreach ($brandids as $k => $id) {
                $return[] = [
                    'id' => $id,
                    'name' => TbBrand::findFirst("id=" . $id)->$name,
                ];
            }
            return $return;
        });

        // 取出儿童品类
        $di->setShared('childbrandgroups', function () use ($admin) {
            $name = $admin->getlangfield('name');
            $products = TbProductSearch::find([
                'conditions' => 'gender = 2',
                'columns' => "brandgroupid",
            ]);
            // 品类id列表
            $brandgroupids = array_unique(array_column($products->toArray(), 'brandgroupid'));
            // 把品牌名称进行整合
            $return = [];
            foreach ($brandgroupids as $k => $id) {
                $return[] = [
                    'id' => $id,
                    'name' => TbBrandgroup::findFirst("id=" . $id)->$name,
                ];
            }
            return $return;
        });

        // 注册微信和支付宝单例服务
        // 支付宝
        $di->setShared('alipay', function () use ($config_array) {
            // 取出支付宝相关配置
            $config = $config_array['pay']['alipay'];
            // 调用 Yansongda\Pay 来创建一个支付宝支付对象
            return Pay::alipay($config);
        });

        // 微信
        $di->setShared('wechat_pay', function () use ($config_array) {
            // 取出支付宝相关配置
            $config = $config_array['pay']['wechat'];
            // 调用 Yansongda\Pay 来创建一个微信支付对象
            return Pay::wechat($config);
        });

        // 当前登录用户的支付宝支付方式
        $di->setShared('alipay_app_auth_token', function () use ($session) {
            // 取出公司id
            if ($session->has('member')) {
                $companyid = $session->get('member')['companyid'];
                // 取出支付方式
                $payment = TbShoppayment::findFirst("companyid=" . $companyid);
                $config = $payment ? json_decode($payment->getConfig(), true) : [];
                // 如果$config不为空，则取出支付参数
                if ($config) {
                    if (array_key_exists('alipayUserToken', $config) && array_key_exists('app_auth_token', $config['alipayUserToken'])) {
                        $app_auth_token = $config['alipayUserToken']['app_auth_token'];
                    } else {
                        $app_auth_token = '';
                    }
                } else {
                    $app_auth_token = '';
                }
            } else {
                $app_auth_token = '';
            }
            // 返回
            return $app_auth_token;
        });

    }
}