<?php

use Phalcon\Acl;
use Phalcon\Events\Event;
use Phalcon\Mvc\User\Plugin;
use Phalcon\Mvc\Dispatcher;
use Phalcon\Acl\Adapter\Memory as AclList;
use Phalcon\Acl\Resource;
use Phalcon\Acl\Role;

class SecurityPlugin extends Plugin
{
    function getAcl() {
        echo "111";
        $acl = $this->session->get("acl");
        if(!$acl) {
            echo "222";
            $acl = new AclList();    
            $acl->addRole("Guests");
            
            // 定义 "Customers" 资源
            $customersResource = new Resource("Customers");
    
            // 为 "customers"资源添加一组操作
            $acl->addResource($customersResource, "search");
            $acl->addResource($customersResource, array("create", "update"));
            $acl->addResource("depart", array("index", "update"));
            
            $acl->deny("Guests", "depart", "index");
            
            $this->session->set("acl", $acl);
        }

        return $acl;
    }
    
    public function beforeExecuteRoute(Event $event, Dispatcher $dispatcher)
    {
        // Check whether the "auth" variable exists in session to define the active role
        $auth = $this->session->get('auth');
        if (!$auth) {
            $role = 'Guests';
        } else {
            $role = 'Users';
        }

        // Take the active controller/action from the dispatcher
        $controller = $dispatcher->getControllerName();
        $action = $dispatcher->getActionName();

        // Obtain the ACL list
        $acl = $this->getAcl();

        // Check if the Role have access to the controller (resource)
        $allowed = $acl->isAllowed($role, $controller, $action);
        
        if ($allowed != Acl::ALLOW) {
            // If he doesn't have access forward him to the index controller  
            if($this->request->isAjax()) {
                $result = array();
                $result["code"] = "201";
                echo json_encode($result);     
            }
            else {
                $this->session->destroy();
                
                $this->flash->error("You don't have access to this module");
                $dispatcher->forward(
                    array(
                        'module' => 'home',
                        'controller' => 'login',
                        'action'     => 'index'
                    )
                );
            }            
            
            // Returning "false" we tell to the dispatcher to stop the current operation
            return false;
        }
    }
}