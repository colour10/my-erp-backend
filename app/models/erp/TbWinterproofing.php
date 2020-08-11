<?php

namespace Asa\Erp;

/**
 * 防寒指数表
 * Class TbWinterproofing
 * @package Asa\Erp
 */
class TbWinterproofing extends BaseModel
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
    public $memo_cn;

    /**
     *
     * @var string
     */
    public $memo_en;

    /**
     *
     * @var string
     */
    public $memo_hk;

    /**
     *
     * @var string
     */
    public $memo_fr;

    /**
     *
     * @var string
     */
    public $memo_it;

    /**
     *
     * @var string
     */
    public $memo_sp;

    /**
     *
     * @var string
     */
    public $memo_de;

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
        $this->setSource('tb_winterproofing');
    }
}
