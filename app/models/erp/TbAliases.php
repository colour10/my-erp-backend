<?php

namespace Asa\Erp;

/**
 * 基础资料 别名表
 * Class TbAliases
 * @package Asa\Erp
 */
class TbAliases extends BaseModel
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
     * @var string
     */
    public $code;

    /**
     *
     * @var integer
     */
    public $brandid;

    /**
     * 初始化
     */
    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_aliases');
    }
}
