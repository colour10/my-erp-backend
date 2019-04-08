<?php
namespace Asa\Erp;
use Phalcon\Validation;
use Phalcon\Validation\Validator\Between;
use Phalcon\Validation\Validator\Uniqueness;

/**
 * 基础资料，商品尺寸表
 */
class TbProperty extends BaseModel
{
    public const BRANDGROUPCHILD = 1;
    
    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_property');
    }

    public function validation() {
        $validator = new Validation();

//        $validator->add(
//            "age",
//            new Between(
//                [
//                    "minimum" => 18,
//                    "maximum" => 60,
//                    "message" => "年龄必须是18~60岁",
//                ]
//            )
//        );
//
//        $validator->add(
//            'name',
//            new Uniqueness(
//                [
//                    'message' => '姓名不能重复',
//                ]
//            )
//        );

        return $this->validate($validator);
    }

    function doUp() {
        $property = static::findFirst([
            sprintf("parent_type=%d and parent_id=%d and displayindex<%d",$this->parent_type, $this->parent_id, $this->displayindex),
            "order" => "displayindex desc"
        ]);

        if($property!=false) {
            $current_index = $this->displayindex;

            $db = $this->getDI()->get("db");

            $db->begin();
            $this->displayindex = $property->displayindex;
            if($this->update()==false) {
                $db->rollback();
                throw new Exception("#1002#更新属性的排序规则失败1#");
            }

            $property->displayindex = $current_index;
            $property->update();
            if($property->update()==false) {
                $db->rollback();
                throw new Exception("#1002#更新属性的排序规则失败2#");
            }

             $db->commit();
        }
    }

    function doDown() {
        $property = static::findFirst([
            sprintf("parent_type=%d and parent_id=%d and displayindex>%d",$this->parent_type, $this->parent_id, $this->displayindex),
            "order" => "displayindex asc"
        ]);

        if($property!=false) {
            $current_index = $this->displayindex;

            $db = $this->getDI()->get("db");

            $db->begin();
            $this->displayindex = $property->displayindex;
            if($this->update()==false) {
                $db->rollback();
                throw new Exception("#1002#更新属性的排序规则失败1#");
            }

            $property->displayindex = $current_index;
            $property->update();
            if($property->update()==false) {
                $db->rollback();
                throw new Exception("#1002#更新属性的排序规则失败2#");
            }

             $db->commit();
        }
    }
}
