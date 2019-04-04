<?php
namespace Asa\Erp;
use Phalcon\Validation;
use Phalcon\Validation\Validator\Between;
use Phalcon\Validation\Validator\Uniqueness;
use Phalcon\Mvc\Model\Relation;

/**
 * 商品表
 */
class TbShoporderCommon extends BaseModel
{
	
	public $id;

	public $order_no;
	
	public $member_id;
	
	public $reciver_name;
 	
 	public $reciver_phone;
 	
 	public $reciver_address;
 	
 	public $reciver_no;
 	
 	public $total_price;
 	
 	public $send_price;
 	
 	public $final_price;
 	
 	public $order_status = 1;
 	
 	public $pay_style = 0;
 	
 	public $create_time;
 	
 	public $pay_time;
	
	
    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_shoporder_common');
        
        // 表关联
        // 与用户表关联，一对多反向
        $this->hasMany(
            "id",
            "\Asa\Erp\TbShoporder",
            "order_commonid",
            [
                'alias' => 'shoporder',
                'foreignKey' => [
                    // 关联字段禁止自动删除
                    'action' => Relation::ACTION_RESTRICT,
                    "message"    => $this->getValidateMessage('belongsto-foreign-message', 'shoporder'),
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
