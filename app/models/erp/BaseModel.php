<?php
namespace Asa\Erp;
use Phalcon\Mvc\Model\Message as Message;
use Asa\Erp\Behavior\AsaBehabior;

class BaseModel extends \Phalcon\Mvc\Model {
    protected $validate_language;
    
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
    
    function setValidateLanguage($language) {
        $this->validate_language = $language;  
    }
    
    function getLanguageColumns() {
        return array();   
    }
    
    function getColumnName($name) {
        $language_columns = $this->getLanguageColumns();
        if(in_array($name, $language_columns)) {
            return sprintf("%s_%s", addslashes($name), $this->validate_language);  
        }   
        else {
            return $name;   
        }
    }

    /**
     * @param $template languages下面语言文件template字段的名称
     * @param $name 待验证字段的编号，显示为当前语言的友好性提示
     */
    function getValidateMessage($template, $name) {

    }

}