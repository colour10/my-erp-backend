<?php
namespace Asa\Erp;
use Phalcon\Mvc\Model\Message as Message;

/**
 * 不是软删除的表的基类
 */
class BaseCommonModel extends \Phalcon\Mvc\Model {
    private $validate_language;
    
    public function initialize() {
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

}