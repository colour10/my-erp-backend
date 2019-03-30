<?php
namespace Asa\Erp;
use Phalcon\Validation;
use Phalcon\Validation\Validator\Between;
use Phalcon\Validation\Validator\Uniqueness;
use Phalcon\Mvc\Model\Relation;

/**
 * 商品表
 */
class TbBuycar extends BaseModel
{
	
	public $id;

	public $product_id;
 	
 	public $member_id;
 	
 	public $number;
	
	
    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_buycar');
        
        // 表关联
        // 与用户表关联，一对多反向
        $this->belongsTo(
            "member_id",
            "\Asa\Erp\TbMember",
            "id",
            [
                'alias' => 'member',
                'foreignKey' => [
                    // 关联字段禁止自动删除
                    'action' => Relation::ACTION_RESTRICT,
                    "message"    => $this->getValidateMessage('belongsto-foreign-message', 'member'),
                ],
            ]
        );
        
        // 与产品表关联，一对多反向
        $this->belongsTo(
            "product_id",
            "\Asa\Erp\TbProduct",
            "id",
            [
                'alias' => 'product',
                'foreignKey' => [
                    // 关联字段禁止自动删除
                    'action' => Relation::ACTION_RESTRICT,
                    "message"    => $this->getValidateMessage('belongsto-foreign-message', 'product'),
                ],
            ]
        );
        
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
