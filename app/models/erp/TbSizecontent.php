<?php

namespace Asa\Erp;

/**
 * 商品尺码明细信息表
 *
 * Class TbSizecontent
 * @package Asa\Erp
 * @property int $id 主键id
 * @property int|null $topid 尺码组主键id
 * @property string|null $name 中文代码名称
 * @property int|null $displayindex 排序
 * @property null $created_at 创建时间
 * @property null $updated_at 更新时间
 * @property-read TbSizetop|null $sizetop 尺码组
 */
class TbSizecontent extends BaseModel
{
    /**
     * 初始化
     */
    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_sizecontent');

        // 尺码详情-尺码组，一对多反向
        $this->belongsTo(
            'topid',
            TbSizetop::class,
            'id',
            [
                'alias' => 'sizetop',
            ]
        );
    }

    /**
     * 向上
     *
     * @throws Exception
     */
    function doUp()
    {
        $property = static::findFirst([
            sprintf("topid=%d and displayindex<%d", $this->topid, $this->displayindex),
            "order" => "displayindex desc",
        ]);

        if ($property != false) {
            $current_index = $this->displayindex;

            $db = $this->getDI()->get("db");

            $db->begin();
            $this->displayindex = $property->displayindex;
            if ($this->update() == false) {
                $db->rollback();
                throw new Exception("#1002#更新尺码详情的排序规则失败1#");
            }

            $property->displayindex = $current_index;
            $property->update();
            if ($property->update() == false) {
                $db->rollback();
                throw new Exception("#1002#更新尺码详情的排序规则失败2#");
            }

            $db->commit();
        }
    }

    /**
     * 向下
     *
     * @throws Exception
     */
    function doDown()
    {
        $property = static::findFirst([
            sprintf("topid=%d and displayindex>%d", $this->topid, $this->displayindex),
            "order" => "displayindex asc",
        ]);

        if ($property != false) {
            $current_index = $this->displayindex;

            $db = $this->getDI()->get("db");

            $db->begin();
            $this->displayindex = $property->displayindex;
            if ($this->update() == false) {
                $this->debug();
                $db->rollback();
                throw new Exception("/1002/更新尺码详情的排序规则失败1/");
            }

            $property->displayindex = $current_index;
            $property->update();
            if ($property->update() == false) {
                $db->rollback();
                throw new Exception("/1002/更新尺码详情的排序规则失败2/");
            }

            $db->commit();
        }
    }

    /**
     * 顶部
     *
     * @throws Exception
     */
    function doTop()
    {
        $min = static::minimum([
            sprintf("topid=%d", $this->topid),
            'column' => 'displayindex',
        ]);

        $this->displayindex = $min - 1;
        if ($this->update() == false) {
            throw new Exception("#1002#更新尺码详情的排序规则失败1#");
        }
    }

    /**
     * 底部
     *
     * @throws Exception
     */
    function doBottom()
    {
        $min = static::maximum([
            sprintf("topid=%d", $this->topid),
            'column' => 'displayindex',
        ]);

        $this->displayindex = $min + 1;
        if ($this->update() == false) {
            throw new Exception("#1002#更新尺码详情的排序规则失败1#");
        }
    }

    /**
     * 验证规则
     *
     * @return array
     */
    public function getRules()
    {
        $factory = $this->getValidatorFactory();
        return [
            'name'  => [$factory->presenceOf('neirong')],
            'topid' => [$factory->tableid('chimazu', false)],
        ];
    }
    
    /**
     * find方法，给 phpstorm 提示用的
     *
     * @param mixed $parameters
     * @return TbSizecontent[]|TbSizecontent|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * findFirst方法，给 phpstorm 提示用的
     *
     * @param mixed $parameters
     * @return TbSizecontent|\Phalcon\Mvc\Model\ResultInterface
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

    /**
     * findFirstById方法，给 phpstorm 提示用的
     *
     * @param $id
     * @return TbSizecontent|\Phalcon\Mvc\Model\ResultInterface
     */
    public static function findFirstById($id)
    {
        return parent::findFirst("id = " . $id);
    }
}
