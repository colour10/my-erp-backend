<?php

namespace Multiple\Home;

use Asa\Erp\StaticReader;
use Asa\Erp\TbPermissionAction;
use Asa\Erp\Util;
use ExceptionPlugin;
use Phalcon\Acl;
use Phalcon\Acl\Adapter\Memory as AclList;
use Phalcon\DiInterface;
use Phalcon\Events\Manager as EventsManager;
use Phalcon\Loader;
use Phalcon\Mvc\Dispatcher;
use Phalcon\Mvc\ModuleDefinitionInterface;
use Phalcon\Mvc\View;
use Phalcon\Text;
use SecurityPlugin;

/**
 * Home 模块的 Module 控制器
 * Class Module
 * @package Multiple\Home
 */
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
                "Multiple\\Home\\Controllers" => "../app/home/controllers/",
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
        $di->set('dispatcher', function () {
            // Create an events manager
            $eventsManager = new EventsManager();

            // 添加一个监听beforeDispatch事件，判断执行的控制器或者动作是否存在，这个动作是最先执行的
            $eventsManager->attach("dispatch:beforeDispatch", function ($event, $dispatcher) {
                // 获取当前controller的名称
                $controllerName = $dispatcher->getControllerName();
                // Controller首字母大写
                $upperControllerName = Text::camelize($controllerName);
                // Controller路径补全
                $controller = "Multiple\\Home\\Controllers\\" . $upperControllerName . "Controller";
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

            // Listen for events produced in the dispatcher using the Security plugin
            $eventsManager->attach('dispatch:beforeExecuteRoute', new SecurityPlugin);

            // Handle exceptions and not-found exceptions using NotFoundPlugin
            // $eventsManager->attach('dispatch:beforeException', new NotFoundPlugin);
            $eventsManager->attach('dispatch:beforeException', new ExceptionPlugin);

            $dispatcher = new Dispatcher();

            $dispatcher->setDefaultNamespace("Multiple\\Home\\Controllers");

            // Assign the events manager to the dispatcher
            $dispatcher->setEventsManager($eventsManager);

            return $dispatcher;
        });

        $config = $di->get("config");

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

        $di->set("acl", function () use ($config, $di) {
            $session = $di->get('session');
            $acl = $session->get("acl");
            if (!$acl) {
                $acl = new AclList();
                $acl->setDefaultAction(Acl::DENY);

                $guest = "Guest";
                $acl->addRole($guest);

                //所有人都可以访问的资源
                $resources = Util::getPublicResourse();

                foreach ($resources as $resource) {
                    $acl->addResource($resource[0], $resource[1]);
                    $acl->allow($guest, $resource[0], $resource[1]);
                }

                //只要是登录的用户就可以访问的资源
                $loginUser = "LoginUser";
                $acl->addRole($loginUser, $guest);
                $resources = Util::getAuthResourse();
                foreach ($resources as $resource) {
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
                if ($auth) {
                    foreach ($auth['actions'] as $resource) {
                        $acl->allow($user, $resource['controller'], $resource['action']);
                    }
                    $session->set("acl", $acl);
                }
            }

            return $acl;
        });

        // 增加一个超级管理员用的模板，为了防止和之前的冲突，这里用了 mview 做区分
        $di->set(
            "mview",
            function () {
                $view = new View();
                $view->setViewsDir('../app/home/mviews/'); // 定义视图层目录
                $view->setLayoutsDir('layouts/');     // 定义布局文件目录
                return $view;
            }
        );
    }
}
