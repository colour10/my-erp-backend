<?php
namespace Asa\Erp;
use Phalcon\Validation;
use Phalcon\Validation\Validator\Uniqueness;
use Phalcon\Mvc\Model\Relation;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\Regex;
/**
 * 发货单主表
 */
class DdConfirmorder extends BaseModel
{
    public function initialize()
    {
        parent::initialize();
        $this->setSource('dd_confirmorder');
        
        // 订单-订单详情，一对多
        $this->hasMany(
            "id",
            "\Asa\Erp\DdConfirmorderdetails",
            "confirmorderid",
            [
                'alias' => 'confirmorderdetails',
                'foreignKey' => array(
                    'message' => '#1003#',
                    'action' => Relation::ACTION_RESTRICT
                )  
            ]
        );
    }

    /**
     * 验证器
     * 因为采用特殊的json参数传值，所以不同于一般的验证
     * @return bool
     */
    public function validation()
    {
        $validator = new Validation();

        // 开始验证
        // 必填字段为：年代id-ageseason；供货商id-supplierid
        // 年代id-ageseason不能为空
        // 供货商id-supplierid必须是正整数
        $validator->add('property', new Regex([
            'message' => $this->getValidateMessage('invalid', 'property'),
            "pattern" => "/^[0-9]+$/",
            'cancelOnFail' => true,
        ]));

        // 供货商id-supplierid必须是正整数
        $validator->add('supplierid', new Regex([
            'message' => $this->getValidateMessage('invalid', 'supplierid'),
            "pattern" => "/^[0-9]+$/",
            'cancelOnFail' => true,
        ]));

        // 返回
        return $this->validate($validator);
    }

    /**
     * 添加一条明细数据
     * @param [type] $form 表单数据
     */
    public function addDetail($form) {
        $row = new DdConfirmorderdetails();
        //print_r($form);
        if($row->create($form)) {
            //print_r($form);
            return $row;
        }
        else {
           
            return false;
        }
    }

    /**
     * 更新明细数据
     * @param  [type] $form 表单数据
     * @return [type]       [description]
     */
    public function updateDetail($form) {
        $row = DdConfirmorderdetails::findFirst(
            sprintf("id=%d", $form['id'])
        );

        if($row!=false && $row->companyid == $form['companyid']) {
            if($row->update($form)) {
                return $row;
            }
            else {
                return false;
            }
        }
        else {
            return false;
        }
    }

    /**
     * 
     */
    function getOrderDetail() {   
        $result = $this->confirmorderdetails ;

        // 循环添加数据
        $productlist = [];
        $list = [];
            $hashmap = [];
        foreach ($this->confirmorderdetails as $k => $row) {
            $temp = $row->toArray();
            $list[] = $row->toArray();
        }

        return [
            'form' => $this->toArray(),
            'list' => $this->confirmorderdetails->toArray()
        ];;
    }
}