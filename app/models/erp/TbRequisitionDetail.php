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

        // 库存-仓库表，一对多反向
       $this->belongsTo(
            'out_productstockid',
            '\Asa\Erp\TbProductstock',
            'id',
            [
                'alias' => 'outProductstock'
            ]
        );

       $this->belongsTo(
            'in_productstockid',
            '\Asa\Erp\TbProductstock',
            'id',
            [
                'alias' => 'inProductstock'
            ]
        );
    }

    function delete() {
        return false;
    }
}
