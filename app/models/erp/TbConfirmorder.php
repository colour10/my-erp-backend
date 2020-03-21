<?php

namespace Asa\Erp;

use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\Relation;

/**
 * 发货单主表
 */
class TbConfirmorder extends BaseModel
{
    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_confirmorder');

        // 订单-订单详情，一对多
        $this->hasMany(
            "id",
            "\Asa\Erp\TbConfirmorderdetails",
            "confirmorderid",
            [
                'alias'      => 'confirmorderdetails',
                'foreignKey' => [
                    'message' => '#1003#',
                    'action'  => Relation::ACTION_RESTRICT,
                ],
            ]
        );
    }

    /**
     * 添加一条明细数据
     * @param [type] $form 表单数据
     * @return TbConfirmorderdetails|bool
     */
    public function addDetail($form)
    {
        $row = new TbConfirmorderdetails();
        if ($row->create($form)) {
            return $row;
        } else {

            return false;
        }
    }

    /**
     * 更新明细数据
     * @param  [type] $form 表单数据
     * @return bool|Model [type]       [description]
     */
    public function updateDetail($form)
    {
        $row = TbConfirmorderdetails::findFirst(
            sprintf("id=%d", $form['id'])
        );

        if ($row != false && $row->companyid == $form['companyid']) {
            if ($row->update($form)) {
                return $row;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    /**
     * 获取订单明细
     */
    function getOrderDetail()
    {
        // 循环添加数据
        $list = [];
        foreach ($this->confirmorderdetails as $k => $row) {
            $list[] = $row->toArray();
        }

        return [
            'form' => $this->toArray(),
            'list' => $this->confirmorderdetails->toArray(),
        ];
    }
}