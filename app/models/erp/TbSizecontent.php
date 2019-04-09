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

    /**
     * 设置多语言字段
     * @return array
     */
    function getLanguageColumns() {
        return ['content'];
    }

    /**
     * 验证器
     * @return bool
     */
    public function validation()
    {
        $validator = new Validation();

        $content = $this->getColumnName("content");
        //echo $content;

        // $content-尺寸代码名称不能为空
        $validator->add($content, new PresenceOf([
            'message' => $this->getValidateMessage('required', 'sizecontent-content'),
            'cancelOnFail' => true,
        ]));

        // 过滤
        $validator->setFilters($content, 'trim');

        return $this->validate($validator);
    }

    /**
     * 重写多语言版本配置读取函数
     * @param languages下面语言文件字段的名称 如template模块下面的uniqueness
     * @param 待验证字段的编号，显示为当前语言的友好性提示 $name
     * @return string
     */
    public function getValidateMessage($template, $name)
    {
        // 定义变量
        // 取出当前语言版本
        $language = $this->getDI()->get('language');
        // 拼接变量
        $template_name = $language->template[$template];
        $human_name = $language->$name;
        // 返回最终的友好提示信息
        return sprintf($template_name, $human_name);
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
}
