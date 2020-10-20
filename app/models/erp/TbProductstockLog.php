<?php

namespace Asa\Erp;

/**
 * 库存日志表
 *
 * Class TbProductstockLog
 * @package Asa\Erp
 * @property int $id 主键id
 * @property int $warehouseid 仓库id
 * @property int $productstockid 库存id
 * @property int $number_before 原来的库存
 * @property int $number_after 现在的库存
 * @property int $change_type 库存变动类型：1-销售；2-调拨入库；3-调拨出库；4-入库；5-残次品入库；6-在途，入库；7-入库取消；8-调拨入库中；9-调拨完毕
 * @property null $change_time 更新时间
 * @property int|null $relationid 对应调拨单明细id
 * @property int|null $companyid 公司id
 * @property int|null $change_stuff 操作人
 */
class TbProductstockLog extends BaseModel
{
    /**
     * 初始化
     */
    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_productstock_log');
    }
}
