<?php

use Phalcon\Acl;
use Phalcon\Events\Event;
use Phalcon\Mvc\User\Plugin;
use Phalcon\Mvc\Dispatcher;
use Phalcon\Acl\Adapter\Memory as AclList;
use Phalcon\Acl\Resource;
use Phalcon\Acl\Role;
use Asa\Erp\Util;
use Asa\Erp\TbPermissionAction;

class SecurityPlugin extends Plugin
{    
    public function beforeExecuteRoute(Event $event, Dispatcher $dispatcher)
    {
        // Check whether the "auth" variable exists in session to define the active role
        $auth = $this->auth;
        if ($auth) {
            $role = "User";
        } else {
            $role = "Guest";
        }

        // Take the active controller/action from the dispatcher
        $controller = $dispatcher->getControllerName();
        $action = $dispatcher->getActionName();

        // Obtain the ACL list
        $acl = $this->getDI()->get("acl");

        // Check if the Role have access to the controller (resource)
        $allowed = $acl->isAllowed($role, $controller, $action);
        
        if ($allowed != Acl::ALLOW) {
            // If he doesn't have access forward him to the index controller
            
            header('Access-Control-Allow-Origin: *');
            header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');
            header('Access-Control-Allow-Methods: Get,Post,Put,OPTIONS');
            $result = array();
            $result["code"] = "201";
            $result["messages"] = ["Access deny."];
            $result["controller"] = $controller;
            $result["action"] = $action;
            $result["role"] = $role;
            $result["auth"] = $auth;
            echo json_encode($result);

            exit;
        }
    }
}