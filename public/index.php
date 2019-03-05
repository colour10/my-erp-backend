<?php

use Phalcon\Loader;
use Phalcon\Mvc\View;
use Phalcon\Mvc\Application;
use Phalcon\Mvc\Router;
use Phalcon\DI\FactoryDefault;
use Phalcon\Db\Adapter\Pdo\Mysql as DbAdapter;
use Phalcon\Session\Adapter\Files as Session;
// 注入公共函数库
use Common\Common as Common;
use Common\Validate as Validate;

try {
    define('APP_PATH', dirname(dirname(__FILE__)));

    error_reporting(E_ALL);

    $config = new \Phalcon\Config\Adapter\Php(APP_PATH . "/app/config/config.php");

    // Register an autoloader
    $loader = new Loader();
    $loader->registerNamespaces(
        array(
            "Demo" => APP_PATH . '/app/models/demo',
            "Asa\Erp" => APP_PATH . '/app/models/erp',
            // 引入公共函数库
            'Common' => APP_PATH . '/common',
        )
    );
    $loader->registerDirs(
        array(
            '../app/controllers/',
            '../app/models/',
            '../app/plugins/',
            // 引入公共函数库
            '../common/',
        )
    )->register();

    //require_once(APP_PATH . "/app/models/vendor/autoload.php");

    // Create a DI
    $di = new FactoryDefault();

    $di['config'] = $config;

    // Start the session the first time when some component request the session service
    $di->setShared('session', function () {
        $session = new Session();
        $session->start();
        return $session;
    });


    // Set the database service
    $di['db'] = function () use ($config) {
        $connection = new DbAdapter($config->database->db->toArray());

        $connection->execute("SET CHARSET 'UTF8'");
        return $connection;
    };

    // Setting up the view component
    $di['view'] = function () {
        $view = new View();
        $view->setViewsDir('../app/views/');
        return $view;
    };

    /**
     * 注册公共函数库
     */
    $di->setShared('common', function () {
        return new Common();
    });

    /**
     * 注册validation验证器
     */
    $di->set('validate', function () {
        $validate = new Validate();
        return $validate;
    });

    $di->set(
        "router",
        function () {
            $router = new Router();

            $router->setDefaultModule("home");

            $router->add(
                "/",
                [
                    "module" => "home",
                    "controller" => "index",
                    "action" => "index"
                ]
            );

            $router->add(
                "/:controller",
                [
                    "module" => "home",
                    "controller" => 1,
                    "action" => "index"
                ]
            );

            $router->add(
                "/:controller/:action",
                [
                    "module" => "home",
                    "controller" => 1,
                    "action" => 2,
                ]
            );

            $router->add(
                "/:module/:controller/:action",
                [
                    "module" => 1,
                    "controller" => 2,
                    "action" => 3,
                ]
            );

            $router->add(
                "/admin/:controller/?",
                [
                    "module" => "admin",
                    "controller" => 1,
                    "action" => "index",
                ]
            );

            $router->add(
                "/admin/:controller/:action\??",
                [
                    "module" => "admin",
                    "controller" => 1,
                    "action" => 2,
                ]
            );

            // 添加api
            $router->add(
                "/api/:controller/?",
                [
                    "module" => "api",
                    "controller" => 1,
                    "action" => "index",
                ]
            );

            $router->add(
                "/api/:controller/:action\??",
                [
                    "module" => "api",
                    "controller" => 1,
                    "action" => 2,
                ]
            );

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
            // 增加api
            "api" => [
                "className" => "Multiple\\Api\\Module",
                "path" => "../app/api/Module.php",
            ]
        ]
    );

    echo $application->handle()->getContent();
} catch (Exception $e) {
    echo "Exception: ", $e->getMessage();
}
