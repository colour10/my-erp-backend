<?php

namespace Asa\Erp;

/**
 * 用户权限表
 * Class TbBillConfirm
 * @package Asa\Erp
 */
class TbUserPermission extends BaseModel
{
    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_user_permission');
    }
}
