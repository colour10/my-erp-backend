<?php
namespace Asa\Erp;
use Phalcon\Mvc\Model\Message as Message;
use Asa\Erp\Behavior\AsaBehabior;
// 引入软删除类
use Phalcon\Mvc\Model\Behavior\SoftDelete;

class BaseModel extends \Phalcon\Mvc\Model {

    // 1表示删除
    const FG_DELETED = '1';
    // 0表示未删除
    const FG_NOT_DELETED = '0';

    private $validate_language;
    
    public function initialize() {
        //$this->addBehavior(new AsaBehabior());
        $this->useDynamicUpdate(true);
    }

    /**
     * 获取查询时候的必须条件，为了保证和软删除表的一致性
     * @return [type] [description]
     */
    function getSearchBaseCondition() {
        return [];
    }
        
    function getLanguage() {
        return $this->getDI()->get("language");
    }
    
    function setValidateLanguage($language) {
        $this->validate_language = $language;  
        //echo $this->validate_language."===";
    }
    
    function getLanguageColumns() {
        return array();   
    }
    
    function getColumnName($name) {
        $language_columns = $this->getLanguageColumns();

        //var_dump( $this->validate_language);

        if(in_array($name, $language_columns)) {
            return sprintf("%s_%s", addslashes($name), $this->validate_language);
        }   
        else {
            return $name;   
        }
    }

    /**
     * 多语言版本配置读取函数
     * @param $template languages下面语言文件字段的名称，如template模块下面的uniqueness
     * @param $name 待验证字段的编号，显示为当前语言的友好性提示
     */
    function getValidateMessage($template, $name) {}

    public static function findByIdString($idstring, $column) {
        if(preg_match("#^\d+(,\d+)*$#", $idstring)) {
            return self::find(
                sprintf("{$column} in (%s)", $idstring)
            );
        }
        else {
            return [];
        }
    }

    function debug() {
        foreach ($this->getMessages() as $message) {
            echo $message->getMessage();
        }
    }

}