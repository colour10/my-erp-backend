<?php

namespace Asa\Erp;

/**
 * 权限表
 */
class TbPermission extends BaseModel
{
    /**
     * 初始化
     */
    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_permission');
    }
}
