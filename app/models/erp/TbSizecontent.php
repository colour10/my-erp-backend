<?php

namespace Asa\Erp;

use Phalcon\Validation;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Mvc\Model\Relation;

/**
 * 商品尺码明细信息表
 */
class TbSizecontent extends BaseModel
{
    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_sizecontent');

        // 尺码详情-尺码组-尺码详情，一对多反向
        $this->belongsTo(
            'topid',
            '\Asa\Erp\TbSizetop',
            'id',
            [
                'alias' => 'sizetop'
            ]
        );
    }

    function doUp() {
        $property = static::findFirst([
            sprintf("topid=%d and displayindex<%d", $this->topid, $this->displayindex),
            "order" => "displayindex desc"
        ]);

        if($property!=false) {
            $current_index = $this->displayindex;

            $db = $this->getDI()->get("db");

            $db->begin();
            $this->displayindex = $property->displayindex;
            if($this->update()==false) {
                $db->rollback();
                throw new Exception("#1002#更新尺码详情的排序规则失败1#");
            }

            $property->displayindex = $current_index;
            $property->update();
            if($property->update()==false) {
                $db->rollback();
                throw new Exception("#1002#更新尺码详情的排序规则失败2#");
            }

             $db->commit();
        }
    }

    function doDown() {
        $property = static::findFirst([
            sprintf("topid=%d and displayindex>%d", $this->topid, $this->displayindex),
            "order" => "displayindex asc"
        ]);

        if($property!=false) {
            $current_index = $this->displayindex;

            $db = $this->getDI()->get("db");

            $db->begin();
            $this->displayindex = $property->displayindex;
            if($this->update()==false) {
                $this->debug();
                $db->rollback();
                throw new Exception("/1002/更新尺码详情的排序规则失败1/");
            }

            $property->displayindex = $current_index;
            $property->update();
            if($property->update()==false) {
                $db->rollback();
                throw new Exception("/1002/更新尺码详情的排序规则失败2/");
            }

             $db->commit();
        }
    }

    function doTop() {
        $min = static::minimum([
            sprintf("topid=%d", $this->topid),
            'column' => 'displayindex'
        ]);

        $this->displayindex = $min-1;
        if($this->update()==false) {
            throw new Exception("#1002#更新尺码详情的排序规则失败1#");
        }
    }

    function doBottom() {
        $min = static::maximum([
            sprintf("topid=%d", $this->topid),
            'column' => 'displayindex'
        ]);

        $this->displayindex = $min+1;
        if($this->update()==false) {
            throw new Exception("#1002#更新尺码详情的排序规则失败1#");
        }
    }
}
