<?php

namespace Asa\Erp;

/**
 * 海关销售单位表
 * Class TbCustomsUnit
 * @package Asa\Erp
 */
class TbCustomsUnit extends BaseModel
{
    /**
     *
     * @var integer
     */
    public $id;

    /**
     *
     * @var string
     */
    public $name;

    /**
     *
     * @var integer
     */
    public $displayindex;

    /**
     *
     * @var string
     */
    public $code;

    /**
     * 初始化
     */
    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_customs_unit');
    }
}
