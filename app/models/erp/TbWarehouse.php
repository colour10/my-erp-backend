<?php

namespace Asa\Erp;

use Phalcon\Validation;
use Phalcon\Validation\Validator\Uniqueness;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Mvc\Model\Relation;

/**
 * 仓库表
 */
class TbWarehouse extends BaseModel
{
    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_warehouse');

        $this->hasMany(
            "id",
            "\Asa\Erp\TbWarehouseUser",
            "warehouseid",
            [
                'alias' => 'warehouseUser',
                'foreignKey' => array(
                    'message' => '#1003#',
                    'action' => Relation::ACTION_RESTRICT
                )                
            ]
        );

        $this->hasMany(
            "id",
            "\Asa\Erp\TdConfirmorder",
            "warehouseid",
            [
                'alias' => 'confirmorder',
                'foreignKey' => array(
                    'message' => '#1003#',
                    'action' => Relation::ACTION_RESTRICT
                )                
            ]
        );

        $this->hasMany(
            "id",
            "\Asa\Erp\TbProductstock",
            "warehouseid",
            [
                'alias' => 'productstocks'
            ]
        );
    }

    /**
     * 验证器
     * @return bool
     */
    public function validation()
    {
        $validator = new Validation();

        // name-仓库名称不能为空
        $validator->add('name', new PresenceOf([
            'message' => $this->getValidateMessage('required', 'name'),
            'cancelOnFail' => true,
        ]));

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

    /**
     * 根据另外一个库存对象，查找本库的相同信息的库存对象，如果没有则创建一个数量为0的库存对象
     * @param  TbProductstock $productstock [description]
     * @return [type]               [description]
     */
    function getLocalStock($productstock) {
        $myproductstock = TbProductstock::findFirst(
            sprintf(
                "companyid=%d and warehouseid=%d and goodsid=%d",
                $productstock->companyid,
                $this->id,
                $productstock->goodsid
            )
        );

        if($myproductstock!=false) {
            return $myproductstock;
        }
        else {
            $data = array(
                "productid" => $productstock->productid,
                "goodsid" => $productstock->goodsid,
                "warehouseid" => $this->id,
                "sizecontentid" => $productstock->sizecontentid,
                "property" => $productstock->property,
                "defective_level" => $productstock->defective_level
            );
            return TbProductstock::initStock($data);
        }
    }
}
