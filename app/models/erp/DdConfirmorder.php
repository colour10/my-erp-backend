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
                'alias' => 'confirmorderdetails',
                'foreignKey' => [
                    // 关联字段存在性验证
                    // ACTION_CASCADE代表有关联则自动删除
                    'action' => Relation::ACTION_CASCADE,
                    "message"    => $this->getValidateMessage('hasmany-foreign-message', 'confirmorderdetail'),
                ],
            ]
        );
    }
}