<?php

namespace Asa\Erp;

/**
 * 基础资料，商品尺码描述子表
 * Class TbTemplatemanage
 * @package Asa\Erp
 */
class TbTemplatemanage extends BaseModel
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
    public $name_cn;

    /**
     *
     * @var string
     */
    public $name_en;

    /**
     *
     * @var string
     */
    public $name_hk;

    /**
     *
     * @var string
     */
    public $name_fr;

    /**
     *
     * @var string
     */
    public $name_it;

    /**
     *
     * @var string
     */
    public $name_sp;

    /**
     *
     * @var string
     */
    public $name_de;

    /**
     *
     * @var integer
     */
    public $tempid;

    /**
     *
     * @var integer
     */
    public $sortnum;

    /**
     * 初始化
     */
    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_templatemanage');
    }
}
