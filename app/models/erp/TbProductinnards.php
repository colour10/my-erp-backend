<?php

namespace Asa\Erp;

/**
 * 内部结构
 */
class TbProductinnards extends BaseModel
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
     * 初始化
     */
    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_productinnards');
    }
}
