<?php
namespace Asa\Erp;
use Phalcon\Validation;
use Phalcon\Validation\Validator\Between;
use Phalcon\Validation\Validator\Uniqueness;

/**
 * 基础资料，商品尺寸表
 */
class TbBrandgroupchildProperty extends BaseModel
{
    public const BRANDGROUPCHILD = 1;
    
    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_brandgroupchild_property');
    }

    function doUp() {
        $property = static::findFirst([
            sprintf("brandgroupchildid=%d and displayindex<%d", $this->brandgroupchildid, $this->displayindex),
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
            sprintf("brandgroupchildid=%d and displayindex>%d", $this->brandgroupchildid, $this->displayindex),
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

    function doTop() {
        $min = static::minimum([
            sprintf("brandgroupchildid=%d", $this->brandgroupchildid),
            'column' => 'displayindex'
        ]);

        $this->displayindex = $min-1;
        if($this->update()==false) {
            throw new Exception("#1002#更新属性的排序规则失败1#");
        }
    }

    function doBottom() {
        $min = static::maximum([
            sprintf("brandgroupchildid=%d", $this->brandgroupchildid),
            'column' => 'displayindex'
        ]);

        $this->displayindex = $min+1;
        if($this->update()==false) {
            throw new Exception("#1002#更新属性的排序规则失败1#");
        }
    }
}
