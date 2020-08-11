<?php

namespace Asa\Erp;

/**
 * 销售端口表, 目前已经没有这个表了，可以删除
 *
 * Class TbSaleportUser
 * @package Asa\Erp
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
                'alias' => 'saleport',
            ]
        );

        $this->belongsTo(
            'userid',
            '\Asa\Erp\TbUser',
            'id',
            [
                'alias' => 'user',
            ]
        );
    }
}
