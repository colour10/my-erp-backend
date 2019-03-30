<?php

namespace Asa\Erp;

use Phalcon\Validation;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Mvc\Model\Relation;

/**
 * 商品尺码明细信息表
 */
class ZlSizecontent extends BaseModel
{
    public function initialize()
    {
        parent::initialize();
        $this->setSource('zl_sizecontent');

        // 尺码详情-尺码组-尺码详情，一对多反向
        $this->belongsTo(
            'topid',
            '\Asa\Erp\ZlSizetop',
            'id',
            [
                'alias' => 'sizetop',
                "foreignKey" => [
                    // 关联字段存在性验证
                    'action' => Relation::ACTION_RESTRICT,
                    "message" => $this->getValidateMessage('notexist', 'sizetop'),
                ],
            ]
        );

        // 尺码-商品尺码关联表，一对多
        $this->hasMany(
            "id",
            "\Asa\Erp\LinkProductToSizecontent",
            "productid",
            [
                'alias' => 'products',
                'foreignKey' => [
                    // 关联字段存在性验证
                    'action' => Relation::ACTION_RESTRICT,
                    "message"    => $this->getValidateMessage('hasmany-foreign-message', 'product'),
                ],
            ]
        );
    }

    /**
     * 设置多语言字段
     * @return array
     */
    function getLanguageColumns() {
        return ['content', 'memo'];
    }

    /**
     * 验证器
     * @return bool
     */
    public function validation()
    {
        $validator = new Validation();

        $content = $this->getColumnName("content");
        // $content-尺寸代码名称不能为空
        $validator->add($content, new PresenceOf([
            'message' => $this->getValidateMessage('required', 'sizecontent-content'),
            'cancelOnFail' => true,
        ]));

        $memo = $this->getColumnName("memo");
        // $memo-尺寸描述
        $validator->add($memo, new PresenceOf([
            'message' => $this->getValidateMessage('required', 'sizecontent-memo'),
            'cancelOnFail' => true,
        ]));

        // 过滤
        $validator->setFilters($content, 'trim');
        $validator->setFilters($memo, 'trim');

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
}
