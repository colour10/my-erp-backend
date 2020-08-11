<?php

namespace Asa\Erp;

/**
 * 发货单费用表
 */
class TbShippingFee extends BaseModel
{
    /**
     *
     * @var integer
     */
    public $id;

    /**
     *
     * @var integer
     */
    public $shippingid;

    /**
     *
     * @var integer
     */
    public $currencyid;

    /**
     *
     * @var double
     */
    public $amount;

    /**
     *
     * @var integer
     */
    public $makestaff;

    /**
     *
     * @var string
     */
    public $maketime;

    /**
     *
     * @var integer
     */
    public $companyid;

    /**
     *
     * @var integer
     */
    public $feenameid;

    /**
     *
     * @var string
     */
    public $memo;

    /**
     *
     * @var double
     */
    public $exchangerate;
    
    /**
     * 初始化
     */
    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_shipping_fee');

        // 发货单费用表-费用表，一对多反向
        $this->belongsTo(
            'feenameid',
            TbFeename::class,
            'id',
            [
                'alias' => 'feename',
            ]
        );
    }
}
