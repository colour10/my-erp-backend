<?php

namespace Asa\Erp;

/**
 * 商品价格表
 *
 * Class TbProductPrice
 * @package Asa\Erp
 * @property int $id 主键id
 * @property int|null $productid 商品id
 * @property int|null $priceid 价格id
 * @property int|null $currencyid 货币id
 * @property float|null $price 价格
 * @property int|null $updatestaff 更新人
 * @property null $updatetime 更新时间
 */
class TbProductPrice extends BaseModel
{
    /**
     * 初始化
     */
    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_product_price');
    }
}
