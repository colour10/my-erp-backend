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
        $acl = $this->session->get("acl");
        if(!$acl) {
            $acl = new AclList();  
            $acl->setDefaultAction(Acl::DENY);
              
            $acl->addRole("Guests");
            
            //所有人都可以访问的资源
            $public_resources = array(
                "login" => ['index', "login", "logout"]
            );
            
            foreach($public_resources as $key => $actions) {
                $acl->addResource($key, $actions);
                $acl->allow("Guests", $key, $actions);           
            }
            
            
            // 定义 "Users" 资源
            $privateResources = array(
                'index' => array("index"),
                'user' => array("index","add",'edit','delete'),
                'errors' => array('index', 'show500', 'show404', 'show401')
            );
            foreach ($privateResources as $resource => $actions) {
                $acl->addResource(new Resource($resource), $actions);
            }
            
            //$acl->allow("Guests", "login", "index");
            //$acl->allow("Guests", "login", "login");            
            
            $this->session->set("acl", $acl);
        }

        return $acl;
    }
    
    public function beforeExecuteRoute(Event $event, Dispatcher $dispatcher)
    {
        // Check whether the "auth" variable exists in session to define the active role
        $user = $this->session->get('user');
        if ($user) {
            $role = 'Users';
        } else {
            $role = 'Guests';            
        }

        // Take the active controller/action from the dispatcher
        $controller = $dispatcher->getControllerName();
        $action = $dispatcher->getActionName();

        // Obtain the ACL list
        $acl = $this->getAcl();

        // Check if the Role have access to the controller (resource)
        $allowed = $acl->isAllowed($role, $controller, $action);
        
        if ($allowed != Acl::ALLOW && false) {
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