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

use Phalcon\Acl;
use Phalcon\Acl\Adapter\Memory as AclList;
use Phalcon\Acl\Resource;
use Phalcon\Acl\Role;
use Asa\Erp\Util;
use Asa\Erp\TbPermissionAction;
use Asa\Erp\StaticReader;

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
            $auth = $di->get("auth");

            $language = $config->language;
            if($auth && isset($auth['language']) && $auth['language']!="" && preg_match("#^[a-z]{2}$#", $auth['language'])) {
                $language = $auth['language'];
            }

            //$system_language = new \Phalcon\Config\Adapter\Php(APP_PATH . "/app/config/languages/{$language}.php");
            $lang = new \Phalcon\Config\Adapter\Php(APP_PATH . "/app/config/languages/{$language}.php");
            $lang->lang = $language;
            return $lang;
        });

        //访问静态列表数据的资源
        $di->setShared('staticReader', function () use ($config, $di) {
            $reader = new StaticReader();
            $reader->setDI($di);
            return $reader;
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

        $di->set("acl", function() use($config, $di) {
            $session = $di->get('session');
            $acl = $session->get("acl");
            if(!$acl) {
                $acl = new AclList();  
                $acl->setDefaultAction(Acl::DENY);
                
                $guest = "Guest";
                $acl->addRole($guest);
                
                //所有人都可以访问的资源
                $resources = Util::getPublicResourse();
                
                foreach($resources as $resource) {
                    $acl->addResource($resource[0], $resource[1]);
                    $acl->allow($guest, $resource[0], $resource[1]);           
                }

                //只要是登录的用户就可以访问的资源
                $loginUser = "LoginUser";
                $acl->addRole($loginUser, $guest);
                $resources = Util::getAuthResourse();
                foreach($resources as $resource) {
                    $acl->addResource($resource[0], $resource[1]);
                    $acl->allow($loginUser, $resource[0], $resource[1]);          
                }

                //定义所有私有资源
                $resources = TbPermissionAction::find();
                foreach ($resources as $resource) {
                    $acl->addResource($resource->controller, $resource->action);
                }
                
                $user = "User";
                $acl->addRole($user, $loginUser);

                $auth = $di->get("auth");
                if($auth) { 
                    foreach ($auth['actions'] as $resource) {
                        $acl->allow($user, $resource['controller'], $resource['action']);      
                    }
                    //print_r($auth['actions']);
                    $session->set("acl", $acl);
                } 
            }

            return $acl;
        });
    }
}