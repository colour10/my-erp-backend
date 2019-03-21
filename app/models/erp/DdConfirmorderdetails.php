<?php

namespace Asa\Erp;

use Phalcon\Validation;
use Phalcon\Mvc\Model\Relation;

/**
 * 发货单明细表
 */
class DdConfirmorderdetails extends BaseModel
{
    public function initialize()
    {
        parent::initialize();
        $this->setSource('dd_confirmorderdetails');

        // 发货单详情-商品主表，一对多反向
        $this->belongsTo(
            'productid',
            '\Asa\Erp\TbProduct',
            'id',
            [
                'alias' => 'product',
                "foreignKey" => [
                    // 关联字段存在性验证
                    'action' => Relation::ACTION_RESTRICT,
                    "message" => $this->getValidateMessage('notexist', 'product'),
                ],
            ]
        );

        // 发货单详情-商品尺码表，一对多反向
        $this->belongsTo(
            'sizecontentid',
            '\Asa\Erp\ZlSizecontent',
            'id',
            [
                'alias' => 'sizecontent',
                "foreignKey" => [
                    // 关联字段存在性验证
                    'action' => Relation::ACTION_RESTRICT,
                    "message" => $this->getValidateMessage('notexist', 'sizecontent'),
                ],
            ]
        );

        // 发货单详情-发货单主表，一对多反向
        $this->belongsTo(
            'confirmorderid',
            '\Asa\Erp\DdConfirmorder',
            'id',
            [
                'alias' => 'confirmorder',
                "foreignKey" => [
                    // 关联字段存在性验证
                    'action' => Relation::ACTION_RESTRICT,
                    "message" => $this->getValidateMessage('notexist', 'confirmorder'),
                ],
            ]
        );

        // 发货单详情-订单详情表，一对多反向
        $this->belongsTo(
            'orderdetailsid',
            '\Asa\Erp\DdOrderdetails',
            'id',
            [
                'alias' => 'orderdetails',
                "foreignKey" => [
                    // 关联字段存在性验证
                    'action' => Relation::ACTION_RESTRICT,
                    "message" => $this->getValidateMessage('notexist', 'orderdetail'),
                ],
            ]
        );
    }

    public function validation() {
        $validator = new Validation();
        return $this->validate($validator);
    }
}
