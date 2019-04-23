<?php
namespace Asa\Erp;

/**
 * 商品描述
 */
class TbProductMemo extends BaseModel
{
    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_product_memo');
    }

    public function getRules() {
        return ['name_cn' => $this->getValidatorFactory()->presenceOfMultiple('mingcheng') ];
    }
}
