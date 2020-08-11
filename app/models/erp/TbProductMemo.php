<?php

namespace Asa\Erp;

/**
 * 商品描述
 *
 * Class TbProductMemo
 * @package Asa\Erp
 */
class TbProductMemo extends BaseModel
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
    public $displayindex;

    /**
     *
     * @var integer
     */
    public $brandgroupchildid;

    /**
     * 初始化
     */
    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_product_memo');
    }

    /**
     * 验证规则
     *
     * @return array
     */
    public function getRules()
    {
        $factory = $this->getValidatorFactory();
        return [
            'name_cn' => [$factory->presenceOfMultiple('mingcheng'), $factory->uniqueness('mingcheng', false)],
            'name_en' => $factory->uniqueness('mingcheng'),
        ];
    }
}
