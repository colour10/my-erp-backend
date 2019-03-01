<?php
use Phalcon\Loader;
use Phalcon\Mvc\View;
use Phalcon\Mvc\Application;
use Phalcon\Mvc\Router;
use Phalcon\DI\FactoryDefault;
use Phalcon\Db\Adapter\Pdo\Mysql as DbAdapter;

try {
    define('APP_PATH', dirname(dirname(__FILE__)));
    
    error_reporting(E_ALL);
    
    $config = new \Phalcon\Config\Adapter\Php(APP_PATH . "/app/config/config.php");
    
    // Register an autoloader
    $loader = new Loader();
    $loader->registerNamespaces(
        array(
            "Demo" => APP_PATH . '/app/models/demo'
        )
    );
    $loader->registerDirs(
        array(
            '../app/controllers/',
            '../app/models/'
        )
    )->register();
    
    require_once(APP_PATH."/app/models/vendor/autoload.php");

    // Create a DI
    $di = new FactoryDefault();
    
    $di['config'] = $config;

//print_r($config->database->db->toArray());exit;

    // Set the database service
    $di['db'] = function() use($config) {
        $connection = new DbAdapter($config->database->db->toArray());
        
        $connection->execute("SET CHARSET 'UTF8'");
        return $connection;
    };

    // Setting up the view component
    $di['view'] = function() {
        $view = new View();
        $view->setViewsDir('../app/views/');
        return $view;
    };
    
    $di->set(
        "router",
        function () {
            $router = new Router();
    
            $router->setDefaultModule("home");
    
            $router->add(
                "/",
                [
                    "module"     => "home",
                    "controller" => "index",
                    "action"     => "index"
                ]
            );
    
            $router->add(
                "/:controller",
                [
                    "module"     => "home",
                    "controller" => 1,
                    "action"     => "index"
                ]
            );
    
            $router->add(
                "/:controller/:action",
                [
                    "module"     => "home",
                    "controller" => 1,
                    "action"     => 2,
                ]
            );            
            
            $router->add(
                "/:module/:controller/:action",
                [
                    "module"     => 1,
                    "controller" => 2,
                    "action"     => 3,
                ]
            );
            
            $router->add(
                "/admin/:controller/?",
                [
                    "module"     => "admin",
                    "controller" => 1,
                    "action"     => "index",
                ]
            );
            
            $router->add(
                "/admin/:controller/:action\??",
                [
                    "module"     => "admin",
                    "controller" => 1,
                    "action"     => 2,
                ]
            );
            
            
            //$router->handle();
            //print_r($router->getMatchedRoute());
            return $router;
        }
    );

    // Handle the request
    $application = new Application($di);
    
    // ×¢²áÄ£¿é
    $application->registerModules(
        [
            "home" => [
                "className" => "Multiple\\Home\\Module",
                "path"      => "../app/home/Module.php",
            ],
            "admin"  => [
                "className" => "Multiple\\Admin\\Module",
                "path"      => "../app/admin/Module.php",
            ]
        ]
    );
    
    //phpinfo();
    //print_r($_SERVER);exit;

    echo $application->handle()->getContent();
} catch (Exception $e) {
     echo "Exception: ", $e->getMessage();
}
