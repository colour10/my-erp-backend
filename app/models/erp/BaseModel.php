<?php
namespace Asa\Erp;
use Phalcon\Mvc\Model\Message as Message;
use Asa\Erp\Behavior\AsaBehabior;
use Phalcon\Db\Column;

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
        $language = $this->validate_language;
        if($language=="") {
            $language = $this->getLanguage();
            $language = $language['lang'];
        }

        if(in_array($name, $language_columns)) {
            return sprintf("%s_%s", addslashes($name), $language);
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
        if(is_array($idstring)) {
            $idstring = implode(',', $idstring);
        }
        
        if(preg_match("#^\d+(,\d+)*$#", $idstring)) {
            return static::find(
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

    public function toArrayPipe() {
        return $this->toArray();
    }

    public static function doList($form, $oderby="") {            
        $where = static::getSearchCondition($form);
        
        $params = [$where];
        if($oderby!="") {
            $params['order'] = $oderby;
        }
        $result = static::find($params);       
        
        $list = array();
        foreach($result as $row) { 
             $list[] = $row->toArrayPipe();
        }   
        return $list;
    }

    public static function getSearchCondition($form) {
        $class = new \ReflectionClass(get_called_class());
        $model = $class->newInstance();
        $metaData = $model->getModelsMetaData();
        $primaryKeys = $metaData->getPrimaryKeyAttributes($model);
        $fieldTypes = $metaData->getDataTypes($model);
        
        //var_dump($fieldTypes);

        $array = $model->getSearchBaseCondition();

        foreach ($fieldTypes as $key=>$value) {
            if(isset($form[$key]) && $form[$key]!="" ) {
                if ($fieldTypes[$key] == Column::TYPE_INTEGER || $fieldTypes[$key] == Column::TYPE_BIGINTEGER ) {
                    $array[] = sprintf("%s=%d", $key, $form[$key]);
                } else { //($fieldTypes[$key] == Column::TYPE_CHAR || $fieldTypes[$key] == Column::TYPE_VARCHAR) {
                    $array[] = sprintf("%s='%s'", $key, addslashes($form[$key]));
                }
            }
        }

        return implode(' and ', $array);
    }
}