<?php

namespace Asa\Erp;

/**
 * 费用名称
 *
 * Class TbFeename
 * @package Asa\Erp
 */
class TbFeename extends BaseModel
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
    public $is_amortize;

    /**
     *
     * @var integer
     */
    public $amortize_type;

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
        $this->setSource('tb_feename');
    }
}
