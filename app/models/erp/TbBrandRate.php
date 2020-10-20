<?php

namespace Asa\Erp;

/**
 * 品牌倍率表
 *
 * Class TbBrandRate
 * @package Asa\Erp
 * @property int $id 主键id
 * @property int|null $brandid 品牌id
 * @property int|null $ageseasonid 年代季节id
 * @property int|null $brandgroupid 品类id
 * @property float|null $rate 倍率
 * @property int|null $modifystaff 更新人
 * @property null $modifytime 更新时间
 */
class TbBrandRate extends BaseModel
{
    /**
     * 初始化
     */
    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_brand_rate');
    }
}
