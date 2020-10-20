<?php

namespace Asa\Erp;

/**
 * 商品库存检索表
 *
 * Class TbProductstockSearch
 * @package Asa\Erp
 * @property int $id 主键id
 * @property int|null $companyid 公司
 * @property int|null $productid 产品
 * @property int|null $warehouseid 仓库
 * @property int|null $property 0-自采 1-代销
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
 * @property string|null $productmemoids 商品描述
 * @property bool|null $spring 春
 * @property bool|null $summer 夏
 * @property bool|null $fall 秋
 * @property bool|null $winter 冬
 * @property int|null $series 商品系列
 * @property string|null $sizecontentids 尺码组明细
 * @property string|null $sizecontent_data 尺码数据
 * @property int|null $reserve_number 锁定数量
 * @property int|null $sales_number 已售数量
 */
class TbProductstockSearch extends BaseModel
{
    /**
     * 初始化
     */
    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_productstock_search');
    }

    function getDataList()
    {
        $result = [];
        $array = explode(';', $this->sizecontent_data);
        foreach ($array as $row) {
            $temp = explode(',', $row);
            $result[] = [
                "sizecontentid"  => $temp[0],
                "number"         => $temp[1],
                "reserve_number" => $temp[2],
                "sales_number"   => $temp[3],
            ];
        }

        return $result;
    }
}
