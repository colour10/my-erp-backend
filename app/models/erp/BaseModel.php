<?php

namespace Asa\Erp;

use Phalcon\Db\Column;
use Phalcon\Mvc\Model;
use Phalcon\Validation;

/**
 * 基本 Model
 * Class BaseModel
 * @package Asa\Erp
 */
class BaseModel extends Model
{
    protected $validatorFactory;

    public function initialize()
    {
        // 动态更新，只更新变化的字段，非常有用
        $this->useDynamicUpdate(true);
    }

    function getValidatorFactory()
    {
        if (!$this->validatorFactory) {
            $this->validatorFactory = new ValidatorFactory();
            $this->validatorFactory->setDI($this->getDI());
        }

        return $this->validatorFactory;
    }

    /**
     * 获取查询时候的必须条件，为了保证和软删除表的一致性
     * @return array [type] [description]
     */
    function getSearchBaseCondition()
    {
        return [];
    }

    /**
     * 多语言版本配置读取函数
     * @param string $template languages下面语言文件字段的名称，如template模块下面的uniqueness
     * @param string $name 待验证字段的编号，显示为当前语言的友好性提示
     */
    function getValidateMessage($template, $name)
    {
    }

    /**
     * 根据 id 读取
     *
     * @param $idString
     * @param $column
     * @return array|Model\ResultsetInterface
     */
    public static function findByIdString($idString, $column)
    {
        if (is_array($idString)) {
            $idString = implode(',', $idString);
        }

        if (preg_match("#^\d+(,\d+)*$#", $idString)) {
            return static::find(
                sprintf("{$column} in (%s)", $idString)
            );
        } else {
            return [];
        }
    }

    /**
     * 调试
     */
    function debug()
    {
        foreach ($this->getMessages() as $message) {
            echo $message->getMessage();
        }
    }

    /**
     * 转成数组
     *
     * @return array
     */
    public function toArrayPipe()
    {
        return $this->toArray();
    }

    /**
     * 获取搜索条件
     *
     * @param $form
     * @return string
     * @throws \ReflectionException
     */
    public static function getSearchCondition($form)
    {
        $class = new \ReflectionClass(get_called_class());
        $model = $class->newInstance();
        $metaData = $model->getModelsMetaData();
        $primaryKeys = $metaData->getPrimaryKeyAttributes($model);
        $fieldTypes = $metaData->getDataTypes($model);

        $array = $model->getSearchBaseCondition();

        foreach ($fieldTypes as $key => $value) {
            if (isset($form[$key]) && $form[$key] != "") {
                if ($fieldTypes[$key] == Column::TYPE_INTEGER || $fieldTypes[$key] == Column::TYPE_BIGINTEGER) {
                    $array[] = sprintf("%s=%d", $key, $form[$key]);
                } else { //($fieldTypes[$key] == Column::TYPE_CHAR || $fieldTypes[$key] == Column::TYPE_VARCHAR) {
                    $array[] = sprintf("%s='%s'", $key, addslashes($form[$key]));
                }
            }
        }

        return implode(' and ', $array);
    }

    public static function fetchById($id)
    {
        $row = static::findFirstById($id);
        if ($row != false) {
            return $row->toArray();
        } else {
            return false;
        }
    }

    /**
     * 返回具体的校验规则列表
     * @return array [type] [description]
     */
    function getRules()
    {
        return [];
    }

    /**
     * 数据校验方法
     * @return bool [type] [description]
     */
    public function validation()
    {
        $rules = $this->getRules();

        if (count($rules) > 0) {
            $validation = new Validation();

            foreach ($rules as $field => $rule) {
                if (is_array($rule)) {
                    foreach ($rule as $row) {
                        $validation->add($field, $row);
                    }
                } else {
                    $validation->add($field, $rule);
                }
            }

            return $this->validate($validation);
        } else {
            return true;
        }
    }

    /**
     * find方法，给 phpstorm 提示用的
     *
     * @param mixed $parameters
     * @return static[]|static|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * findFirst方法，给 phpstorm 提示用的
     *
     * @param mixed $parameters
     * @return static|\Phalcon\Mvc\Model\ResultInterface
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

    /**
     * findFirstById方法，给 phpstorm 提示用的
     *
     * @param $id
     * @return static|\Phalcon\Mvc\Model\ResultInterface
     */
    public static function findFirstById($id)
    {
        return parent::findFirst("id = " . $id);
    }
}
