<?php

namespace Asa\Erp;

/**
 * 品牌倍率表
 * Class TbBrandRate
 * @package Asa\Erp
 */
class TbBrandRate extends BaseModel
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
    public $brandid;

    /**
     *
     * @var integer
     */
    public $ageseasonid;

    /**
     *
     * @var integer
     */
    public $brandgroupid;

    /**
     *
     * @var double
     */
    public $rate;

    /**
     *
     * @var integer
     */
    public $modifystaff;

    /**
     *
     * @var string
     */
    public $modifytime;

    /**
     * 初始化
     */
    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_brand_rate');
    }
}
