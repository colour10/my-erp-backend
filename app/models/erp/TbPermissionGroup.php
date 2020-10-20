<?php

namespace Asa\Erp;

/**
 * 权限-组模型
 *
 * Class TbPermissionGroup
 * @package Asa\Erp
 * @property int $id 主键id
 * @property int $groupid 组id
 * @property int $permissionid 权限id
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
