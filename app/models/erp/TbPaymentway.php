<?php

namespace Asa\Erp;

/**
 * 付款方式表
 *
 * Class TbPaymentway
 * @package Asa\Erp
 * @property int $id 主键id
 * @property string|null $name 名称
 * @property int|null $companyid 公司id
 * @property int|null $displayindex 排序
 */
class TbPaymentway extends BaseModel
{
    /**
     * 初始化
     */
    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_paymentway');
    }
}
