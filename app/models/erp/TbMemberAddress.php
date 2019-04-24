<?php

namespace Asa\Erp;

/**
 * 会员相关，地址信息表
 */
class TbMemberAddress extends BaseModel
{
    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_member_address');

        // 会员地址表-会员表，一对多反向
        $this->belongsTo(
            'member_id',
            '\Asa\Erp\TbMember',
            'id',
            [
                'alias' => 'member',
            ]
        );
    }
}
