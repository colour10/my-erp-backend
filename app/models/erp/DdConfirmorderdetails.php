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

        // 发货单详情-发货单主表，一对多反向
        $this->belongsTo(
            'confirmorderid',
            '\Asa\Erp\DdConfirmorder',
            'id',
            [
                'alias' => 'confirmorder'
            ]
        );
        // 发货单详情-订单详情表，一对多反向
        $this->belongsTo(
            'orderdetailsid',
            '\Asa\Erp\DdOrderdetails',
            'id',
            [
                'alias' => 'orderdetails'
            ]
        );
    }
    public function validation() {
        $validator = new Validation();
        return $this->validate($validator);
    }
}