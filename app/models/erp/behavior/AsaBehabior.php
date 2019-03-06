<?php
namespace Asa\Erp\Behavior;
use Phalcon\Mvc\Model\Behavior;
use Phalcon\Mvc\Model\BehaviorInterface;
use Phalcon\Mvc\Model\Message;

class AsaBehabior extends Behavior implements BehaviorInterface {
    public function notify($eventType, $model) {
        //echo $eventType."\n";
        if($eventType=="beforeValidationOnCreate") {
            $current = $model->getDI()->get("currentUser");
        
            
            if($current!="") {
                $now = date("Y-m-d H:i:s");
                $model->sys_create_stuff = $current;
                $model->sys_modify_stuff = $current;
                $model->sys_delete_flag = 0;
                $model->sys_create_date = $now;
                $model->sys_modify_date = $now;
            }
            else { 
                $language = $model->getLanguage();
                $message = new Message($language["model-delete-message"]);	    
    	        $model->appendMessage($message);
    	        return false;
    	    }
        }
        elseif($eventType=="beforeValidationOnUpdate") {
            $current = $model->getDI()->get("currentUser");
        
            if($current!="") {
                $now = date("Y-m-d H:i:s");
                $model->sys_modify_stuff = $current;
                $model->sys_modify_date = $now;
            }
            else { 
                $language = $model->getLanguage();
                $message = new Message($language["model-delete-message"]);	    
    	        $model->appendMessage($message);
    	        return false;
    	    }
        }
    }
}