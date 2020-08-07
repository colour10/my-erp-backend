<?php

namespace Asa\Erp;

/**
 * 调拨单相关，调拨单明细表
 */
class TbRequisitionDetail extends BaseCompanyModel
{
    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_requisition_detail');

        // 库存-调入仓库，一对多反向
        $this->belongsTo(
            'out_productstockid',
            '\Asa\Erp\TbProductstock',
            'id',
            [
                'alias' => 'outProductstock',
            ]
        );

        // 调拨表-调出仓库，一对多反向
        $this->belongsTo(
            'in_productstockid',
            '\Asa\Erp\TbProductstock',
            'id',
            [
                'alias' => 'inProductstock',
            ]
        );
    }

    function delete()
    {
        return false;
    }
}
