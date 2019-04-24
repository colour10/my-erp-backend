<?php
namespace Asa\Erp;

/**
 * 销售端口表
 */
class TbSaleportUser extends BaseModel
{
    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_saleport_user');

        $this->belongsTo(
            'saleportid',
            '\Asa\Erp\TbSaleport',
            'id',
            [
                'alias' => 'saleport'
            ]
        );

        $this->belongsTo(
            'userid',
            '\Asa\Erp\TbUser',
            'id',
            [
                'alias' => 'user'
            ]
        );
    }
}
