<?php

namespace Asa\Erp;

/**
 * 商品条目表
 *
 * Class TbGoods
 * @package Asa\Erp
 * @property int $id 主键id
 * @property int $productid 商品id
 * @property int $sizecontentid 尺码id
 * @property bool|null $defective_level 残次品等级；0=合格品 1=残次品
 * @property bool|null $property 采购类型：0-自采; 1-代销
 * @property null $change_time 修改时间
 * @property int|null $change_stuff 修改人
 * @property float $price 价格
 * @property int $companyid 公司id
 */
class TbGoods extends BaseModel
{
    /**
     * 初始化
     */
    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_goods');
    }
}
