<?php

namespace Asa\Erp;

/**
 * 查询表
 */
class TbProductSearch extends BaseCompanyModel {
    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_product_search');

        // 库存-商品主表，一对多反向
        $this->belongsTo(
            'productid',
            '\Asa\Erp\TbProduct',
            'id',
            [
                'alias' => 'product'
            ]
        );
    }

}
