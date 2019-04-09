<?php

namespace Multiple\Home;

use Phalcon\Loader;
use Phalcon\Mvc\View;
use Phalcon\DiInterface;
use Phalcon\Mvc\Dispatcher;
use Phalcon\Mvc\ModuleDefinitionInterface;
use Phalcon\Events\Manager as EventsManager;
use SecurityPlugin;
use ExceptionPlugin;

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
                "Multiple\\Home\\Controllers" => "../app/home/controllers/"
            ]
        );

        $loader->register();
    }

    /**
     * 注册自定义服务
     */
    public function registerServices(DiInterface $di)
    {        
        $di->set('dispatcher', function () {    
            // Create an events manager
            $eventsManager = new EventsManager();
        
            // Listen for events produced in the dispatcher using the Security plugin
            $eventsManager->attach('dispatch:beforeExecuteRoute', new SecurityPlugin);
        
            // Handle exceptions and not-found exceptions using NotFoundPlugin
            //$eventsManager->attach('dispatch:beforeException', new NotFoundPlugin);
            //
            $eventsManager->attach('dispatch:beforeException', new ExceptionPlugin);
        
            $dispatcher = new Dispatcher();
            
            $dispatcher->setDefaultNamespace("Multiple\\Home\\Controllers");
        
            // Assign the events manager to the dispatcher
            $dispatcher->setEventsManager($eventsManager);
        
            return $dispatcher;
        });

        $config = $di->get("config");
        $di->setShared('language', function () use ($config, $di) {
            $language = $config->language;
            //$system_language = new \Phalcon\Config\Adapter\Php(APP_PATH . "/app/config/languages/{$language}.php");
            return new \Phalcon\Config\Adapter\Php(APP_PATH . "/app/config/languages/{$language}.php");
        });

        $di->setShared('currentUser', function () use ($config, $di) {
            $session = $di->get('session');
            if ($session->has("user")) {
                // Retrieve its value
                $user = $session->get("user");
                return $user["id"];
            } else {
                return "";
            }
        });

        $di->setShared('currentCompany', function () use ($config, $di) {
            $session = $di->get('session');
            if ($session->has("user")) {
                // Retrieve its value
                $user = $session->get("user");
                return $user["companyid"];
            } else {
                return "";
            }
        });
        
        $di->setShared('auth', function () use ($config, $di) {
            $session = $di->get('session');
            if ($session->has("user")) {
                // Retrieve its value
                $user = $session->get("user");
                return $user;
            } else {
                return false;
            }
        });

        // Registering the view component
        $di->set(
            "view",
            function () {
                $view = new View();

                $view->setViewsDir("../app/home/views/");
                //echo realpath("../app/home/views/");
                $view->disable();
                return $view;
            }
        );
    }
}