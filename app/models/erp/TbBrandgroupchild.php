<?php

namespace Asa\Erp;

use Phalcon\Validation;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\Uniqueness;
use Phalcon\Mvc\Model\Relation;

/**
 * 子子品类
 */
class TbBrandgroupchild extends BaseModel
{
    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_brandgroupchild');

        // 子品类-品类，一对多反向
        $this->belongsTo(
            'brandgroupid',
            '\Asa\Erp\TbBrandgroup',
            'id',
            [
                'alias' => 'brandgroup'
            ]
        );

        // 子品类-商品，一对多
        $this->hasMany(
            "id",
            "\Asa\Erp\TbProduct",
            "childbrand",
            [
                'alias' => 'products',
                'foreignKey' => [
                    // 关联字段存在性验证
                    'action' => Relation::ACTION_RESTRICT,
                    "message"    => "#1003#子类已经在商品信息中使用#",
                ],
            ]
        );
    }


    /**
     * 设置多语言字段
     * @return array
     */
    function getLanguageColumns() {
        return ['name'];
    }

    /**
     * 验证器
     * @return bool
     */
    public function validation()
    {
        $validator = new Validation();
/*
        $name = $this->getColumnName("name");
        // name-子品类名称不能为空或者重复
        $validator->add($name, new PresenceOf([
            'message' => $this->getValidateMessage('required', 'name'),
            'cancelOnFail' => true,
        ]));
        $validator->add($name, new Uniqueness([
            'message' => $this->getValidateMessage('uniqueness', 'name'),
            'cancelOnFail' => true,
        ]));
        // code-子品类编码
        $validator->add('childcode', new PresenceOf([
            'message' => $this->getValidateMessage('required', 'code'),
            'cancelOnFail' => true,
        ]));
        $validator->add('childcode', new Uniqueness([
            'message' => $this->getValidateMessage('uniqueness', 'code'),
            'cancelOnFail' => true,
        ]));*/

        // 过滤
 //       $validator->setFilters($name, 'trim');

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

    function getPropertyList() {
        return TbProperty::find(
            sprintf("parent_type=%d and parent_id=%d", TbProperty::BRANDGROUPCHILD, $this->id)
        );
    }

    function delete() {
        if(count($this->getPropertyList())>0) {
            throw new Exception('/1003/子品类数据正在属性中使用，不能删除/');//
        }
        else {
            return parent::delete();
        }
    }
}