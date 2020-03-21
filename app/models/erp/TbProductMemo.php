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

    public function getRules()
    {
        $factory = $this->getValidatorFactory();
        return [
            'name_cn' => [$factory->presenceOfMultiple('mingcheng'), $factory->uniqueness('mingcheng', false)],
            'name_en' => $factory->uniqueness('mingcheng'),
        ];
    }
}
