<?php

namespace Asa\Erp;

/**
 * 商品货号表
 * Class TbProductcode
 * @package Asa\Erp
 */
class TbProductcode extends BaseModel
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
    public $productid;

    /**
     *
     * @var integer
     */
    public $sizecontentid;

    /**
     *
     * @var string
     */
    public $goods_code;

    /**
     *
     * @var integer
     */
    public $companyid;

    /**
     * 初始化
     */
    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_productcode');
    }
}
