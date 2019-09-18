<?php

use Phalcon\Loader;
use Phalcon\Mvc\View;
use Phalcon\Mvc\Application;
use Phalcon\Mvc\Router;
use Phalcon\DI\FactoryDefault;
use Phalcon\Db\Adapter\Pdo\Mysql as DbAdapter;
use Phalcon\Session\Adapter\Files as Session;
use Phalcon\Events\Manager as EventsManager;
use Phalcon\Logger;
use Phalcon\Logger\Adapter\File as FileLogger;

ini_set('date.timezone', 'Asia/Shanghai');

try {
    define('APP_PATH', dirname(dirname(__FILE__)));

    error_reporting(E_ALL);
      ini_set('display_errors', 'On');

    $config = new \Phalcon\Config\Adapter\Php(APP_PATH . "/app/config/config.php");

    // Register an autoloader
    $loader = new Loader();
    $loader->registerNamespaces(
        array(
            "Asa\Erp" => APP_PATH . '/app/models/erp',
            "Asa\Erp\Behavior" => APP_PATH . '/app/models/erp/behavior',
            // 新增测试临时表模型
            "Asa\Models\Temp" => APP_PATH . '/app/models/temp',
        )
    );
    $loader->registerDirs(
        array(
            '../app/models/',
            '../app/plugins/',
        )
    )->register();

    //require_once(APP_PATH . "/app/models/vendor/autoload.php");

    // 添加插件自动加载
    require_once(APP_PATH . "/vendor/autoload.php");

    // Create a DI
    $di = new FactoryDefault();

    $di['config'] = $config;

    // Start the session the first time when some component request the session service
    $di->setShared('session', function () {
        $session = new Session();

        if(isset($_REQUEST["_session_id"])) {
            $session->setId($_REQUEST["_session_id"]);
        }

        $session->start();
        //$session->setId(time());

        return $session;
    });

    // Set the database service
    $di['db'] = function () use ($config) {
        if($config->mode=='develop') {
            $eventsManager = new EventsManager();

            $logger = new FileLogger($config->app->log_path . sprintf("/weblog_%s.log",date('Ymd')));

            // Listen all the database events
            $eventsManager->attach('db', function ($event, $connection) use ($logger) {
                if ($event->getType() == 'beforeQuery') {
                    $logger->log(\Phalcon\Logger::INFO, $connection->getSQLStatement());
                }
            });

            $connection = new DbAdapter($config->database->db->toArray());

            $connection->execute("SET CHARSET 'UTF8'");

            $connection->setEventsManager($eventsManager);
            return $connection;
        }
        else {

            $connection = new DbAdapter($config->database->db->toArray());

            $connection->execute("SET CHARSET 'UTF8'");
            return $connection;
        }
    };

    $di->set( "router", function () use ($config, $di){
            $router = new Router();

            $router->setDefaultModule("home");

            //ERP系统路由规则
            $router->add(
                "/",
                [
                    "module" => "home",
                    "controller" => "index",
                    "action" => "index"
                ]
            )->setHostName($config->app->main_host);

            $router->add(
                "/:controller",
                [
                    "module" => "home",
                    "controller" => 1,
                    "action" => "index"
                ]
            )->setHostName($config->app->main_host);

            $router->add(
                "/:controller/:action",
                [
                    "module" => "home",
                    "controller" => 1,
                    "action" => 2,
                ]
            )->setHostName($config->app->main_host);

            $router->add(
                "/l/([a-z]+)",
                [
                    "module" => "home",
                    "controller" => "common",
                    "action" => "list",
                    "table" => 1
                ]
            )->setHostName($config->app->main_host);


            // 店铺域名路由规则
            $router->add(
                "/",
                [
                    "module" => "shop",
                    "controller" => "index",
                    "action" => "index"
                ]
            )->setHostName($config->app->shop_host);

            $router->add(
                "/:controller",
                [
                    "module" => "shop",
                    "controller" => 1,
                    "action" => "index"
                ]
            )->setHostName($config->app->shop_host);

            $router->add(
                "/:controller/:action",
                [
                    "module" => "shop",
                    "controller" => 1,
                    "action" => 2,
                ]
            )->setHostName($config->app->shop_host);

            // 添加新路由，多一个自定义参数
            $router->add(
                "/:controller/:action/:params",
                [
                    "module" => "shop",
                    "controller" => 1,
                    "action" => 2,
                    "params" => 3,
                ]
            )->setHostName($config->app->shop_host);

            $router->add(
                "/common/systemlanguage",
                [
                    "module" => "home",
                    "controller" => "common",
                    "action" => "systemlanguage"
                ]
            )->setHostName($config->app->shop_host);

            $router->add(
                "/common/loadname",
                [
                    "module" => "home",
                    "controller" => "common",
                    "action" => "loadname"
                ]
            )->setHostName($config->app->shop_host);

            $router->add(
                "/l/([a-z]+)",
                [
                    "module" => "home",
                    "controller" => "common",
                    "action" => "list",
                    "table" => 1
                ]
            )->setHostName($config->app->shop_host);

            return $router;
        }
    );

    // Handle the request
    $application = new Application($di);

    // 注册模块
    $application->registerModules(
        [
            "home" => [
                "className" => "Multiple\\Home\\Module",
                "path" => "../app/home/Module.php",
            ],
            "admin" => [
                "className" => "Multiple\\Admin\\Module",
                "path" => "../app/admin/Module.php",
            ],
            "shop" => [
                "className" => "Multiple\\Shop\\Module",
                "path" => "../app/shop/Module.php",
            ]
        ]
    );

    echo $application->handle()->getContent();
} catch (Exception $e) {
    echo "Exception: ", $e->getMessage();
}
