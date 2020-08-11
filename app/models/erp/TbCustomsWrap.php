<?php

namespace Asa\Erp;

/**
 * 包装代码表
 * Class TbCustomsWrap
 * @package Asa\Erp
 */
class TbCustomsWrap extends BaseModel
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
    public $code;

    /**
     *
     * @var string
     */
    public $name;

    /**
     *
     * @var string
     */
    public $sname;

    /**
     *
     * @var integer
     */
    public $displayindex;

    /**
     * 初始化
     */
    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_customs_wrap');
    }
}
