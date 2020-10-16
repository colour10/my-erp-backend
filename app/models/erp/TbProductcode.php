<?php

namespace Asa\Erp;

/**
 * 商品货号表
 *
 * Class TbProductcode
 * @package Asa\Erp
 * @property int $id 主键id
 * @property int|null $productid 商品id
 * @property int|null $sizecontentid 尺码id
 * @property string|null $goods_code 货号
 * @property int|null $companyid 公司id
 */
class TbProductcode extends BaseModel
{
    /**
     * 初始化
     */
    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_productcode');
    }
}
