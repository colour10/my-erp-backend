<?php
namespace Asa\Erp;
use Phalcon\Mvc\Model\Message as Message;
use Asa\Erp\Behavior\AsaBehabior;

class BaseModel extends \Phalcon\Mvc\Model {
    public function initialize() {
        $this->addBehavior(new AsaBehabior());        
    }
    
    function delete() {
        $current = $this->getDI()->get("currentUser");
        
        if($current!="") {
            $now = date("Y-m-d H:i:s");
            $this->sys_delete_stuff = $current;
            $this->sys_delete_flag = 1;
            $this->sys_delete_date = $now;
            $this->sys_modify_date = $now;
            
            return $this->save();
        }
        else { 
            $language = $this->getLanguage();
            $message = new Message($language["model-delete-message"]);	    
	        $this->appendMessage($message);
	        return false;
	    }
    }
    
    function getLanguage() {
        return $this->getDI()->get("language");
    }
}