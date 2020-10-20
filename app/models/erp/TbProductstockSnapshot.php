<?php

namespace Asa\Erp;

/**
 * 库存快照表
 *
 * Class TbProductstockSnapshot
 * @package Asa\Erp
 * @property int $id 主键id
 * @property null $snapdate 快照日期
 * @property int|null $productstockid 库存id
 * @property int|null $productid 商品id
 * @property int|null $sizeid 尺码id
 * @property int|null $stockid 仓库ID
 * @property int|null $productno 商品编码
 * @property null $selltime 销售时间
 * @property float|null $sellprice 销售价格
 * @property float|null $cost 成本
 * @property int|null $selltype 0-待销；1-已售出；2-预定；3-在途；4-调拨锁定
 * @property float|null $dealprice 销售价格
 * @property int|null $qualitystatus 0-合格品；1-残次品；2-库存差异
 * @property int|null $sellstaff 销售人
 * @property int|null $corderid 发货单id
 * @property int|null $currencyid 结算货币id
 * @property string|null $memo 备注
 * @property null $cpdate 属性
 * @property null $intime 到店时间
 * @property string|null $property 采购类型：0-自采; 1-代销
 * @property string|null $kpflag 0-未开票 1-已开票
 * @property int $decadeid 到货年代
 */
class TbProductstockSnapshot extends BaseModel
{
    /**
     * 初始化
     */
    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_productstock_snapshot');
    }
}
