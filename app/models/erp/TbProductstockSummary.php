<?php

namespace Asa\Erp;

/**
 * 商品库存检索表
 *
 * Class TbProductstockSummary
 * @package Asa\Erp
 * @property int $id 主键id
 * @property int|null $companyid 公司
 * @property int $warehouseid 仓库id
 * @property int|null $productid 产品
 * @property int|null $property 属性
 * @property bool|null $defective_level 残品
 * @property int|null $number 数量
 * @property string|null $wordcode 国际码
 * @property string|null $ageseason 年代
 * @property string|null $countries 产地
 * @property int|null $brandid 品牌
 * @property int|null $brandgroupid 品类
 * @property int|null $childbrand 子品类
 * @property int|null $brandcolor 色系
 * @property string|null $ulnarinch 商品尺寸
 * @property int|null $saletypeid 销售属性
 * @property int|null $producttypeid 商品属性
 * @property string|null $gender 性别
 * @property bool|null $spring 春
 * @property bool|null $summer 夏
 * @property bool|null $fall 秋
 * @property bool|null $winter 冬
 * @property int|null $series 商品系列
 * @property null $laststoragedate 最后入库时间
 * @property int|null $sizecontentid 尺码组id
 * @property int|null $reserve_number 锁定数量
 * @property int|null $sales_number 已售数量
 * @property int $shipping_number 在途数量
 * @property null $created_at
 * @property null $updated_at
 */
class TbProductstockSummary extends BaseModel
{
    /**
     * 初始化
     */
    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_productstock_summary');
    }
}
