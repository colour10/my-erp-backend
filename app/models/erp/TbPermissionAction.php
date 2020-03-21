<?php

namespace Asa\Erp;

/**
 * 权限模型关联表
 */
class TbPermissionAction extends BaseModel
{
    /**
     * 初始化
     */
    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_permission_action');
    }
}
