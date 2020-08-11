<?php

namespace Asa\Erp;

/**
 * 货币表
 */
class TbCurrency extends BaseModel
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
        $this->setSource('tb_currency');
    }

    /**
     * 删除
     *
     * @return bool|void
     * @throws \Exception
     */
    function delete()
    {
        throw new \Exception("/1003/币种信息不允许删除/");
    }
}
