<?php

namespace Asa\Erp;

use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\Resultset;

/**
 * 年代季节
 */
class TbAgeseason extends BaseModel
{
    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_ageseason');
    }

    public function getRules()
    {
        return [
            'name'        => $this->getValidatorFactory()->year('nianfen'),
            'sessionmark' => $this->getValidatorFactory()->presenceOf('fabuji'),
        ];
    }

    public function toArrayPipe()
    {
        $fullname = sprintf("%s%s", $this->sessionmark, $this->name);
        $array = $this->toArray();
        $array['fullname'] = $fullname;
        return $array;
    }

    function delete()
    {
        throw new \Exception("/1003/款式年代数据不允许删除/");
    }


    /**
     * 取出当前时间的上一个年代季节
     * @param string $mark 季节
     * @param string $name 年份
     * @return bool|Resultset|Model
     */
    public static function getPrevAgeseason($mark, $name)
    {
        // 逻辑
        // 验证季节
        switch ($mark) {
            // 如果输入月份为下半年，季节变，年份不变
            case "FW":
                $prevMark = 'SS';
                $prevName = $name;
                break;
            // 如果输入年代为上半年，季节变，年份变-1
            case "SS":
                $prevMark = 'FW';
                $prevName = $name - 1;
                break;
            default:
                $prevMark = 'SS';
                $prevName = $name;
                break;
        }
        // 开始查找对应的id
        if ($model = TbAgeseason::findFirst("sessionmark='$prevMark' and name='$prevName'")) {
            return $model->id;
        } else {
            return false;
        }
    }
}