<?php

namespace Asa\Erp;

/**
 * 调拨单明细表
 *
 * Class TbRequisitionDetail
 * @package Asa\Erp
 * @property int $id 主键id
 * @property int $requisitionid 调拨单id
 * @property int|null $out_productstockid 调出库存id
 * @property int|null $in_productstockid 调入库存id
 * @property int|null $number 数量
 * @property string|null $memo 备注
 * @property int|null $out_number 出库数量
 * @property int|null $in_number 入库数量
 * @property-read TbProductstock|null $outProductstock 调入仓库
 * @property-read TbProductstock|null $inProductstock 调出仓库
 */
class TbRequisitionDetail extends BaseCompanyModel
{
    /**
     * 初始化
     */
    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_requisition_detail');

        // 库存-调入仓库，一对多反向
        $this->belongsTo(
            'out_productstockid',
            TbProductstock::class,
            'id',
            [
                'alias' => 'outProductstock',
            ]
        );

        // 调拨表-调出仓库，一对多反向
        $this->belongsTo(
            'in_productstockid',
            TbProductstock::class,
            'id',
            [
                'alias' => 'inProductstock',
            ]
        );
    }

    /**
     * 删除
     *
     * @return bool
     */
    function delete()
    {
        return false;
    }
}
