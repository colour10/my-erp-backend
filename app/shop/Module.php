<?php

namespace Multiple\Shop;

use Asa\Erp\StaticReader;
use Asa\Erp\TbBrand;
use Asa\Erp\TbBrandgroup;
use Asa\Erp\TbCompany;
use Asa\Erp\TbCurrency;
use Asa\Erp\TbProductSearch;
use Asa\Erp\TbShoppayment;
use Asa\Erp\Util;
use Exception;
use Multiple\Shop\Controllers\AdminController;
use Multiple\Shop\Controllers\BrandgroupController;
use Multiple\Shop\Controllers\BuycarController;
use Multiple\Shop\Controllers\CompanyController;
use Phalcon\Config\Adapter\Php;
use Phalcon\DiInterface;
use Phalcon\Events\Manager as EventsManager;
use Phalcon\Loader;
use Phalcon\Mvc\Dispatcher;
use Phalcon\Mvc\ModuleDefinitionInterface;
use Phalcon\Mvc\View;
use Phalcon\Queue\Beanstalk;
use Phalcon\Text;
use PHPMailer\PHPMailer\PHPMailer;
use Yansongda\Pay\Pay;

class Module implements ModuleDefinitionInterface
{
    /**
     * 注册自定义加载器
     * @param DiInterface|null $di
     */
    public function registerAutoloaders(DiInterface $di = null)
    {
        $loader = new Loader();

        $loader->registerNamespaces(
            [
                "Multiple\\Shop\\Controllers" => "../app/shop/controllers/",
                "Multiple\\Shop\\Exceptions"  => "../app/shop/exceptions/",
            ]
        );

        $loader->register();
    }


    /**
     * 注册自定义服务
     * @param DiInterface $di
     */
    public function registerServices(DiInterface $di)
    {
        // 常用的一些参数，下面这些变量将会被用到多次，所以放在上面
        $config = $di->get("config");
        $config_array = $config->toArray();
        $session = $di->get('session');
        $language = $session->get('language') ?: $config->language;

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
                                        'action'     => 'show404',
                                    ]
                                );
                                break;
                            default:
                                $dispatcher->forward(
                                    [
                                        'controller' => 'error',
                                        'action'     => 'show500',
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
            return $config['file_prex'];
        });

        // 为了使用共享model数据，需要注册language
        $di->setShared('language', function () use ($language) {
            return new Php(APP_PATH . "/app/config/languages/{$language}.php");
        });

        // language转换成数组
        $di->setShared('languageArr', function () use ($language, $di) {
            return $di->get('language')->toArray();
        });

        // 取出前5个主分类
        $brandGroup = new BrandgroupController();
        $di->setShared('frontcates', function () use ($brandGroup) {
            return $brandGroup->frontcatesAction();
        });

        // 取出从第6条开始剩下的主分类
        $di->setShared('leftcates', function () use ($brandGroup) {
            return $brandGroup->leftcatesAction();
        });

        // 取出所有的主分类
        $di->setShared('allfirstcates', function () use ($brandGroup) {
            return $brandGroup->allfirstcatesAction();
        });

        // 取出所有的主分类以及二级分类
        $di->setShared('allcates', function () use ($brandGroup) {
            return $brandGroup->allcatesAction();
        });

        // 获取购物车
        $buycar = new BuycarController();
        $di->setShared('buycar', function () use ($buycar) {
            return $buycar->getListsAction();
        });

        // 获取当前域名及所属公司的模型
        $tbcompany = new CompanyController();
        $di->setShared('host', function () use ($tbcompany) {
            return $tbcompany->gethost();
        });

        // 获取所有公司列表
        $di->setShared('allcompany', function () {
            return TbCompany::find()->toArray();
        });

        // 为了使用共享model数据，需要注册currentCompany
        $di->setShared('currentCompany', function () use ($session) {
            // 如果未登录，则返回空
            if (!$session->has("member")) {
                return '';
            }
            return $session->get('member')['companyid'];
        });

        // 默认货币，以后会从配置文件导入，这个先随便写个，有变动在修改
        $di->setShared('currency', function () {
            return "$";
        });

        // 默认联系邮箱
        $di->setShared('contactEmail', function () {
            return "88888888@qq.com";
        });

        // 登录用户信息
        $di->setShared('member', function () use ($di, $session) {
            // 如果未登录，则返回空
            if (!$session->has("member")) {
                return [];
            }
            return $session->get('member');
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
            Util::closeDisplayErrors();
            // 连接到队列
            $beanstalk = new Beanstalk(
                [
                    "host" => "127.0.0.1",
                    "port" => "11300",
                ]
            );
            try {
                if ($beanstalk->connect()) {
                    return $beanstalk;
                }
            } catch (Exception $e) {
                // 记录错误信息
                error_log('Beanstalk开启失败，错误信息是：' . $e->getMessage());
                // 如果没有连接，返回否
                return false;
            }
        });

        // 取出欧元
        $di->setShared('eur', function () {
            if (!$currency = TbCurrency::findFirst("name_cn='欧元'")) {
                return 0;
            }
            return $currency->id;
        });

        // 取出女性品牌，gender=2
        $di->setShared('girlbrands', function () use ($di) {
            $name = $di->get('obj')->getlangfield('name');
            $products = TbProductSearch::find([
                'conditions' => 'gender = 2',
                'columns'    => "brandid",
            ]);
            // 品牌id列表
            $brandids = array_unique(array_column($products->toArray(), 'brandid'));
            // 把品牌名称进行整合
            $return = [];
            foreach ($brandids as $k => $id) {
                $return[] = [
                    'id'   => $id,
                    'name' => TbBrand::findFirst("id=" . $id)->$name,
                ];
            }
            return $return;
        });

        // 取出女性品类，gender=2
        $di->setShared('girlbrandgroups', function () use ($di) {
            $name = $di->get('obj')->getlangfield('name');
            $products = TbProductSearch::find([
                'conditions' => 'gender = 2',
                'columns'    => "brandgroupid",
            ]);
            // 品类id列表
            $brandgroupids = array_unique(array_column($products->toArray(), 'brandgroupid'));
            // 把品牌名称进行整合
            $return = [];
            foreach ($brandgroupids as $k => $id) {
                $return[] = [
                    'id'   => $id,
                    'name' => TbBrandgroup::findFirst("id=" . $id)->$name,
                ];
            }
            return $return;
        });

        // 取出男性品牌，gender=1
        $di->setShared('boybrands', function () use ($di) {
            $name = $di->get('obj')->getlangfield('name');
            $products = TbProductSearch::find([
                'conditions' => 'gender = 1',
                'columns'    => "brandid",
            ]);
            // 品牌id列表
            $brandids = array_unique(array_column($products->toArray(), 'brandid'));
            // 把品牌名称进行整合
            $return = [];
            foreach ($brandids as $k => $id) {
                $return[] = [
                    'id'   => $id,
                    'name' => TbBrand::findFirst("id=" . $id)->$name,
                ];
            }
            return $return;
        });

        // 取出男性品类，gender=1
        $di->setShared('boybrandgroups', function () use ($di) {
            $name = $di->get('obj')->getlangfield('name');
            $products = TbProductSearch::find([
                'conditions' => 'gender = 1',
                'columns'    => "brandgroupid",
            ]);
            // 品类id列表
            $brandgroupids = array_unique(array_column($products->toArray(), 'brandgroupid'));
            // 把品牌名称进行整合
            $return = [];
            foreach ($brandgroupids as $k => $id) {
                $return[] = [
                    'id'   => $id,
                    'name' => TbBrandgroup::findFirst("id=" . $id)->$name,
                ];
            }
            return $return;
        });

        // 取出儿童品牌，gender=6
        $di->setShared('childbrands', function () use ($di) {
            $name = $di->get('obj')->getlangfield('name');
            $products = TbProductSearch::find([
                'conditions' => 'gender = 6',
                'columns'    => "brandid",
            ]);
            // 品牌id列表
            $brandids = array_unique(array_column($products->toArray(), 'brandid'));
            // 把品牌名称进行整合
            $return = [];
            foreach ($brandids as $k => $id) {
                $return[] = [
                    'id'   => $id,
                    'name' => TbBrand::findFirst("id=" . $id)->$name,
                ];
            }
            return $return;
        });

        // 取出儿童品类，gender=6
        $di->setShared('childbrandgroups', function () use ($di) {
            $name = $di->get('obj')->getlangfield('name');
            $products = TbProductSearch::find([
                'conditions' => 'gender = 6',
                'columns'    => "brandgroupid",
            ]);
            // 品类id列表
            $brandgroupids = array_unique(array_column($products->toArray(), 'brandgroupid'));
            // 把品牌名称进行整合
            $return = [];
            foreach ($brandgroupids as $k => $id) {
                $return[] = [
                    'id'   => $id,
                    'name' => TbBrandgroup::findFirst("id=" . $id)->$name,
                ];
            }
            return $return;
        });

        // 当前公司的支付配置对象
        $di->setShared('shopPayment', function () use ($di) {
            // 取出支付宝相关配置currentCompany
            // 如果未登录
            if (!$companyid = $di->get('currentCompany')) {
                return [];
            }
            // 取出支付方式
            if (!$payment = TbShoppayment::findFirst("companyid=" . $companyid)) {
                // 如果不存在，则新增一条记录
                $payment = new TbShoppayment();
                $payment->setCompanyid($companyid);
                $payment->save();
            }
            // 返回
            return $payment;
        });


        // 当前公司的支付配置config
        $di->setShared('shopPaymentConfig', function () use ($di) {
            // 取出支付宝相关配置currentCompany
            if (!$payment = $di->get('shopPayment')) {
                return [];
            }
            // 返回
            return $payment->getConfig();
        });


        // 支付宝app_auth_token
        $di->setShared('app_auth_token', function () use ($di) {
            // 逻辑
            // 如果结果为空
            if (!$config = $di->get('shopPaymentConfig')) {
                return '';
            }

            // 取出app_auth_token，但是不能过期，如果过期就要重新授权
            // 下面的逻辑确保app_auth_token为空，或者是在有效期之内
            if (
                array_key_exists('alipayUserToken', $config) &&
                array_key_exists('app_auth_token', $config['alipayUserToken']) &&
                array_key_exists('alipayQueryToken', $config) &&
                array_key_exists('auth_end', $config['alipayQueryToken']) &&
                date('Y-m-d H:i:s') < $config['alipayQueryToken']['auth_end']
            ) {
                return $config['alipayUserToken']['app_auth_token'];
            } else {
                // 删除失效的token记录，赋值为NULL
                $di->get('shopPayment')->setConfig(NULL);
                $di->get('shopPayment')->save();
                return '';
            }
        });


        // 微信sub_mch_id，这个可以为空，对于没有赋值的场景，暂时设置为0
        $di->setShared('sub_mch_id', function () use ($di) {
            // 逻辑
            // 如果结果为空
            if (!$config = $di->get('shopPaymentConfig')) {
                return 0;
            }
            // 判断是否存在
            if (
                !array_key_exists('wechatpay', $config) ||
                !array_key_exists('sub_mch_id', $config['wechatpay'])
            ) {
                return 0;
            }
            // 返回sub_mch_id
            return $config['wechatpay']['sub_mch_id'];
        });


        // 注册微信和支付宝单例服务
        // 支付宝
        $di->setShared('alipay', function () use ($config_array, $di) {
            // 取出支付宝相关配置
            // app_auth_token，这个是必填项
            $config_array['pay']['alipay']['app_auth_token'] = $di->get('app_auth_token');
            // 调用 Yansongda\Pay 来创建一个支付宝支付对象
            return Pay::alipay($config_array['pay']['alipay']);
        });

        // 微信
        $di->setShared('wechat_pay', function () use ($config_array, $di) {
            // 取出微信相关配置
            $config = $config_array['pay']['wechat'];
            // 添加子商户号
            $config_array['pay']['wechat']['sub_mch_id'] = $di->get('sub_mch_id');
            // 调用 Yansongda\Pay 来创建一个微信支付对象
            return Pay::wechat($config);
        });

    }
}
