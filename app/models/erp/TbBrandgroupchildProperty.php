<?php

namespace Asa\Erp;

/**
 * 基础资料，商品尺寸表
 *
 * Class TbBrandgroupchildProperty
 * @package Asa\Erp
 * @property int $id 主键id
 * @property string|null $name_cn 中文名称
 * @property string|null $name_en 英文名称
 * @property string|null $name_hk 粤语名称
 * @property string|null $name_fr 法语名称
 * @property string|null $name_it 意大利语名称
 * @property string|null $name_sp 西班牙语名称
 * @property string|null $name_de 德语名称
 * @property int|null $brandgroupchildid 所属id
 * @property int|null $displayindex 显示顺序
 * @property int|null $propertyid 属性id
 */
class TbBrandgroupchildProperty extends BaseModel
{
    // 默认品类
    const BRANDGROUPCHILD = 1;

    /**
     * 初始化
     */
    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_brandgroupchild_property');
    }

    function doUp()
    {
        $property = static::findFirst([
            sprintf("brandgroupchildid=%d and displayindex<%d", $this->brandgroupchildid, $this->displayindex),
            "order" => "displayindex desc",
        ]);

        if ($property != false) {
            $current_index = $this->displayindex;

            $db = $this->getDI()->get("db");

            $db->begin();
            $this->displayindex = $property->displayindex;
            if ($this->update() == false) {
                $db->rollback();
                throw new Exception("#1002#更新属性的排序规则失败1#");
            }

            $property->displayindex = $current_index;
            $property->update();
            if ($property->update() == false) {
                $db->rollback();
                throw new Exception("#1002#更新属性的排序规则失败2#");
            }

            $db->commit();
        }
    }

    function doDown()
    {
        $property = static::findFirst([
            sprintf("brandgroupchildid=%d and displayindex>%d", $this->brandgroupchildid, $this->displayindex),
            "order" => "displayindex asc",
        ]);

        if ($property != false) {
            $current_index = $this->displayindex;

            $db = $this->getDI()->get("db");

            $db->begin();
            $this->displayindex = $property->displayindex;
            if ($this->update() == false) {
                $db->rollback();
                throw new Exception("#1002#更新属性的排序规则失败1#");
            }

            $property->displayindex = $current_index;
            $property->update();
            if ($property->update() == false) {
                $db->rollback();
                throw new Exception("#1002#更新属性的排序规则失败2#");
            }

            $db->commit();
        }
    }

    function doTop()
    {
        $min = static::minimum([
            sprintf("brandgroupchildid=%d", $this->brandgroupchildid),
            'column' => 'displayindex',
        ]);

        $this->displayindex = $min - 1;
        if ($this->update() == false) {
            throw new Exception("#1002#更新属性的排序规则失败1#");
        }
    }

    function doBottom()
    {
        $min = static::maximum([
            sprintf("brandgroupchildid=%d", $this->brandgroupchildid),
            'column' => 'displayindex',
        ]);

        $this->displayindex = $min + 1;
        if ($this->update() == false) {
            throw new Exception("#1002#更新属性的排序规则失败1#");
        }
    }
}
