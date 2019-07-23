<?php
namespace Asa\Erp;
use Phalcon\Mvc\Model\Message as Message;
use Phalcon\Db\Column;
use Phalcon\Validation;

class BaseModel extends \Phalcon\Mvc\Model {
    protected $validatorFactory;
    
    public function initialize() {
        $this->useDynamicUpdate(true);
    }

    function getValidatorFactory() {
        if(!$this->validatorFactory) {
            $this->validatorFactory = new ValidatorFactory(); 
            $this->validatorFactory->setDI($this->getDI());
        }

        return $this->validatorFactory;
    }

    /**
     * 获取查询时候的必须条件，为了保证和软删除表的一致性
     * @return [type] [description]
     */
    function getSearchBaseCondition() {
        return [];
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

    public static function fetchById($id) {
        $row = static::findFirstById($id);
        if($row!=false) {
            return $row->toArray();
        }
        else {
            return false;
        }
    }

    /**
     * 返回具体的校验规则列表
     * @return [type] [description]
     */
    function getRules() {
        return [];
    }

    /**
     * 数据校验方法
     * @return [type] [description]
     */
    public function validation() {
        $rules = $this->getRules();

        if(count($rules)>0) {
            $validation = new Validation();

            foreach($rules as $field =>$rule) {
                if(is_array($rule)) {
                    foreach($rule as $row) {
                        $validation->add($field, $row);
                    }
                }
                else {
                    $validation->add($field, $rule);
                }                
            }

            return $this->validate($validation);
        }
        else {
            return true;
        }
        
    }
}