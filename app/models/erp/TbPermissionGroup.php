<?php

namespace Asa\Erp;

/**
 * 权限-组模型
 */
class TbPermissionGroup extends BaseModel
{
    /**
     * 初始化
     */
    public function initialize()
    {
        parent::initialize();
        $this->setSource('tb_permission_group');
    }
}
