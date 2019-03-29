<?php
namespace Asa\Erp;
use Phalcon\Validation;
use Phalcon\Mvc\Model\Relation;
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
                'alias' => 'confirmorderdetails'
            ]
        );
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